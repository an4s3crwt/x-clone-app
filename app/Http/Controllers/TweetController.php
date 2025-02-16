<?php

namespace App\Http\Controllers;
use App\Models\Tweet;
use Illuminate\Http\Request;


class TweetController extends Controller
{
    // Constructor que asegura que solo los usuarios autenticados puedan acceder a la página de tweets
    public function __construct(){
        // Middleware que obliga a estar autenticado para acceder a cualquier método en este controlador
        $this->middleware('auth');
    }

    /**
     * Muestra los tweets de los usuarios que el usuario autenticado sigue, además de los propios.
     */
    public function index()
    {
        // Obtenemos los IDs de los usuarios a los que sigue el usuario autenticado utilizando la relación 'follows'
        $followingIds = auth()->user()->follows()->pluck('id');

        // Agregamos el propio ID del usuario a la lista para mostrar también sus propios tweets
        $followingIds->push(auth()->id());

        // Obtenemos todos los tweets de los usuarios que sigue el usuario autenticado, ordenados por fecha descendente
        $tweets = Tweet::whereIn('user_id', $followingIds)
            ->orderBy('created_at', 'desc') // Ordenamos los tweets por la fecha de creación
            ->paginate(20); // Paginamos los tweets a 20 por página

        // Pasamos los tweets a la vista para ser mostrados
        return view('tweets.index', [
            'tweets' => $tweets, // Inyectamos los tweets a la vista
        ]);
    }

    /**
     * Elimina un tweet.
     */
    public function destroy(Tweet $tweet)
    {
        // Eliminamos el tweet de la base de datos
        Tweet::where('id', $tweet->id)->delete();
        
        // Redirigimos de nuevo a la página anterior después de la eliminación
        return back();
    }

    /**
     * Almacena un nuevo tweet en la base de datos.
     */
    public function store(Request $request)
    {
        // Validamos los datos del tweet, asegurándonos de que el texto no sea más largo de 255 caracteres
        $validated = $request->validate([
            'body' => 'required|max:255', // El tweet debe tener un contenido obligatorio y un límite de 255 caracteres
            'tweetImage' => 'nullable', // La imagen es opcional
            'tweetImage.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Aseguramos que las imágenes sean de los tipos permitidos y no pesen más de 2MB
        ]);

        // Asignamos al tweet el ID del usuario autenticado
        $validated['user_id'] = auth()->id();

        // Si el usuario ha subido imágenes, las procesamos
        if ($request->hasFile('tweetImage')) {
            $imagePaths = [];
            foreach ($request->file('tweetImage') as $image) {
                // Guardamos cada imagen en el almacenamiento público y añadimos la ruta al array
                $imagePaths[] = $image->store('tweetImages', 'public');
            }
            // Convertimos el array de rutas de imagen a formato JSON para almacenarlo en la base de datos
            $validated['tweetImage'] = json_encode($imagePaths); // Guardamos como JSON
        }

        // Creamos el tweet en la base de datos con los datos validados
        Tweet::create($validated);

        // Establecemos un mensaje flash para indicar que el tweet se publicó correctamente
        session()->flash('message', 'Tweet posted successfully');

        // Redirigimos al usuario a la página de tweets
        return redirect(route('tweets.index'));
    }

    /**
     * Muestra el formulario de edición de un tweet.
     * Solo el usuario propietario del tweet puede editarlo.
     */
    public function edit(Tweet $tweet)
    {
        // Verificamos si el usuario autenticado es el propietario del tweet
        if (auth()->user()->id !== $tweet->user_id) {
            abort(403); // Si no es el dueño, abortamos y retornamos un error 403 (Forbidden)
        }

        // Retornamos la vista de edición pasando el tweet a editar
        return view('tweets.edit', compact('tweet'));
    }

    /**
     * Actualiza un tweet existente.
     */
    public function update(Request $request, Tweet $tweet)
    {
        // Verificamos si el usuario autenticado es el propietario del tweet
        if (auth()->user()->id !== $tweet->user_id) {
            abort(403); // Si no es el dueño, abortamos con un error 403
        }

        // Validamos que el contenido del tweet sea obligatorio y no exceda los 280 caracteres
        $request->validate([
            'body' => 'required|max:280', // El tweet debe tener un contenido de máximo 280 caracteres
        ]);

        // Actualizamos el cuerpo del tweet con los nuevos datos
        $tweet->update([
            'body' => $request->body,
        ]);

        // Redirigimos al usuario a la página de tweets con un mensaje de éxito
        return redirect()->route('tweets.index')->with('message', 'Tweet actualizado.');
    }
}

