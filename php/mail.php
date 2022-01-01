<?php 
    $to = $correo;
    $subjet = 'Gracias por tu compra en Pernos & Pernos';
    $from = 'pernos@dominio.com';
    $header='MIME-Version 1.0'."\r\n";
    $header.="Content-type: text/html; charset=iso-8859-1\r\n";
    $header.="X-Mailer: PHP/".phpversion();
    $message= '<html>
    <body>
        <div style="width:70%;margin:0 auto; height:80px; background:#7971ea; display:flex; justify-content:space-between; align-items:center;">
            <h1 style="margin:0;color:#fff; padding: 0 2rem;font-family: fantasy;letter-spacing: 1px;">Pernos y Pernos</h1>
            <div style="margin:0;color:#fff; padding: 0 2rem;display: flex;align-items: center;">
                <a href="" style="font-size: 20px;color:#fff; text-decoration: none;font-family: sans-serif;">Comprar</a>
                <img src="../images/img/comprar.svg" style="width: 36px; margin: 0 1rem;">
            </div>
        </div>
        
        <div style="width:70%;margin:0 auto; height:620px;border: 1px solid #dcdcdc;display: flex;flex-direction: column;justify-content: center;align-items: center;font-family: Lucida Sans, Lucida Sans Regular, Lucida Grande, Geneva, Verdana, sans-serif;" >
            <img src="../images/img/confirm.svg" style="width:120px; margin-top:2.5rem">
            <h4 style="color:rgb(124, 124, 124);font-size: 2rem; margin: 0;">Gracias por tu compra '.$nombres.'</h4>
            <p>Gracias por comprar en Pernos & Pernos, su orden ha sido registrado con éxito en nuestro sistema</p>

            <table style="margin: 2rem auto;">
                <thead style="background: rgb(192, 192, 192);">
                    <tr>
                        <td style="margin: 0; padding: .7rem 5rem; color: #000; font-weight: 600;">DETALLES</td>
                        <td style="margin: 0; padding: .7rem 5rem; color: #000; font-weight: 600;" >PRECIO</td>
                    </tr>
                </thead>
                <tbody>';
                    $subtotal = 0;
                    $arregloCarrito =  $_SESSION['carrito'];
                    for($i=0; $i<count($arregloCarrito);$i++){
                        $subtotal=$subtotal + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);
                        $message.='<tr>
                        <td style="margin: 0; padding: .9rem 5rem; color: #9c9c9c; ">'.$arregloCarrito[$i]['Nombre'].' ('.$arregloCarrito[$i]['Cantidad'].')</td><td style="margin: 0; padding: .9rem 5rem; color: #9c9c9c;">S/'.$arregloCarrito[$i]['Precio']*$arregloCarrito[$i]['Cantidad'].'</td>
                        </tr>';
                    }
                    $igv = $subtotal*0.16;
                    $total = $subtotal + $igv;
                $message.='<tr>
                <td style="margin: 0; padding: .7rem 5rem; color: #000; font-weight: 600; border-top: 2px solid rgb(192, 192, 192);">IGV</td>
                <td style="margin: 0; padding: .7rem 5rem; color: #000; font-weight: 600;border-top: 2px solid rgb(192, 192, 192);">S/ '.number_format($igv,2,'.','').'</td></tr><tr>
                <td style="margin: 0; padding: .7rem 5rem; color: #000; font-weight: 600; border-top: 2px solid rgb(192, 192, 192);border-bottom: 2px solid rgb(192, 192, 192);">Total</td>
                <td style="margin: 0; padding: .7rem 5rem; color: #000; font-weight: 600;border-top: 2px solid rgb(192, 192, 192);border-bottom: 2px solid rgb(192, 192, 192);">S/ '.number_format($total,2,'.','').'</td></tr>';
                $message.='</tbody></table>';
    $message.='<a href="http://localhost:8080/Proyectos/Tienda/view-order.php?id_venta'.$id_venta.'" style="background-color: brown;color: white;padding: 10px; text-decoration: none;border-radius: 8px; margin: 20px 0;">Ver el estado del pedido</a></div></body></html>';
    
    if(mail($to,$subjet,$message,$header)){
        echo 'Mensaje enviado correctamente';
    }else{
        echo 'No se pudo enviar el correo';
    }
?>

                    

                    
                
            