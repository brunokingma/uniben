<?php

	class Model_Mail extends RedBean_SimpleModel {

	

		public function enviaemail($post){

			try{

				$email_address = $post['nome'];
				$assunto = $post['assunto'];
				$message = $post['msg'];
				$replay = $post['uemail'];
				$phone = $post['utel'];
					
				// Create the email and send the message
				$to = 'contato@poledanceultra.com.br'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
				$email_subject = "Contato pelo site Pole Dance Ultra.com.br:  $name";
				$email_body = "Email: $replay\n\nTelefone: $phone\n\nMensagem:\n$message";
				$headers = "From: contato@poledanceultra.com.br\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
				$headers .= "Reply-To: $replay";	
				mail($to,$email_subject,$email_body,$headers);				
				
			}catch(Exception $e){
				echo $e;				
			}

			

		}


	



	}



?>