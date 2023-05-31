<?php   

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class MentorController extends Controller
{
    public function mentorizacion(){
        return view("mentorizacion");
    }

    public function registrarMentor(Request $request){

        $data = array(
            'entidad' => $request->input('entidad'),
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel'),
            'twitter' => $request->input('twitter'),
            'instagram' => $request->input('instagram'),
            'linkedin' => $request->input('linkedin'),
            'web' => $request->input('web'),
            'mensaje' => $request->input('mensaje')
          
        );

       $correo = new ContactFormMail();

       try {
       Mail::send('emails.mentores-inscripcion', $data, function($message) use ($data){
        $message->from($data['email']);
        $message->to('maria14998@gmail.com', 'María')
        ->subject('Inscripción como mentor');
        });
        } catch (\Swift_TransportException $e) {
        $mensaje = "Error al enviar el mensaje";
        return view("mentorizacion", compact('mensaje'));
    }
        $mensaje = "Mensaje enviado correctamente";
        return view("mentorizacion", compact('mensaje'));
    }

}
