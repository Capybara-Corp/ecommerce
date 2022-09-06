(function($, param) {
  $(document).ready(function() {
      //alert('hola');
      //console.log("funciona ver articulo");
      var $listaarticulos=[];
      let url= $("#url").val();
      let urlReq =url+"api260260articulos/listar";
      console.log("url: "+urlReq);
      let headers = {"Content-Type":"application/json;charset=utf-8"}; 
      let data = {};
            $.ajax({
              url: urlReq,
              headers: headers,
              type: 'DELETE',
              data: data
          })
          .done(function (data) { 
            $listaarticulos=data.datos;
            console.log($listaarticulos);
           })
          .fail(function (jqXHR, textStatus, errorThrown) { serrorFunction(); });

          //asiganr la funcionalidad del carrito
          const items = document.querySelectorAll(".btnAgregar");
          items.forEach(item => {
          item.addEventListener("click", function(){          
            let articuloId = this.dataset.articuloId;
            console.log(articuloId);
            $articulo= $listaarticulos.find(articulo => articulo.id ==articuloId);
            console.log($articulo);
            console.log("------------------\n");
            $articulo ={};
            var encontrado= false;
            var total = $listaarticulos.length;
            var i= 0;
            while (!encontrado && i<total) {
              $articulo = $listaarticulos[i];
              if ($articulo.id ==articuloId){
                encontrado=true;                
              }//end if
              i++;
            }//end while            
            console.log($articulo);
            //$("#filaart-"+alumnoId).remove();
          });//end item click
      });//end item click items foreach

          



  });//end ready
})(jQuery, "hola mundo");