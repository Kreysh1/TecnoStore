function index(){
    $(document).ready(function($){
        $.ajax({
            url:'Servicios/get_products.php',
            type:'POST',
            data:{},
            success:function(data){
                console.log(data);
                let html='';
                for (var i = 0; i < data.datos.length; i++) {
                    html+=
                    '<div class="product-box">'+
                        '<a href="producto.php?p='+data.datos[i].ID+'">'+
                            '<div class="product">'+
                                '<img src="IMG/'+data.datos[i].Imagen+'">'+
                                '<div class="detail-middle">'+
                                    '<div class="detail-title" id="text">'+data.datos[i].Nombre+'</div>'+
                                    '<div class="detail-description">'+data.datos[i].Descripcion+'</div>'+
                                '</div>'+
                                '<div class="detail-price">'+formato_precio(data.datos[i].Precio)+'</div>'+
                            '</div>'+
                        '</a>'+
                    '</div>';
                }
                document.getElementById("space-list").innerHTML=html;
                session_start();
                $_SESSION['max_products'] = data.datos.length;
            },
            error:function(err){
                console.error(err);
            }
        });
    });
} 

function formato_precio(valor){
    //10.99
    let svalor=valor.toString();
    let array=svalor.split(".");
    return "$"+array[0]+".<span>"+array[1]+"</span>";
}