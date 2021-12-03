<!DOCTYPE html>
<html lang="pt-br">
    <head>        
        <meta charset="UTF-8">
        <title>API ML</title>
        <link rel="stylesheet" type="text/css" href="/style-guide/css/fluig-style-guide.min.css">
        <script src="/portal/resources/js/jquery/jquery.js"></script>
        <script src="/portal/resources/js/jquery/jquery-ui.min.js"></script>
        <script src="/portal/resources/js/mustache/mustache-min.js"></script>
        <script src="/style-guide/js/fluig-style-guide.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      
     

    </head>
    <body>

    <div class="container">
  <div class="row">
    <div class="col">
      
      
    </div>
    <div class="col-6">
    
    <img style="padding:10px;" src="logo.png">
    
    <?php


        $dadosAPI = filter_input(INPUT_GET, 'serialML');

        
        function RemoveSpecialChar($dadosAPI)
        {
            $res = preg_replace('/[-\@\.\;\" "]+/', '', $dadosAPI);
            return $res;
        }
        
        $str1 = RemoveSpecialChar($dadosAPI);
       // echo "My UpdatedString: ", $str1;
        
       
        $url = "https://api.mercadolibre.com/items/".$str1."";
        
        
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $resultado = json_decode(curl_exec($ch));
       


        //echo "ID PAI: " . $resultado->id . "<br>";
    ?>
   
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1" >ID Pai</span>
      <input  type="text"  class="form-control" id="url" value=<?php echo $resultado->id ?> aria-label="Username" aria-describedby="basic-addon1">
    </div>


   
      <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script>

        $(function(){
            $("#url").click(function(){
                $(this).select();
                document.execCommand('copy');
            })

        })
      </script>  

     

 


    <?php



        //echo "TITULO: " . $resultado->title ;

    ?>

        
    <div class="input-group">
      <span class="input-group-text">Title</span>
      <textarea class="form-control"  id="url2" value=<?php echo $resultado->title; ?> aria-label="With textarea"><?php echo$resultado->title;?></textarea>
    </div>

    
    
      <script>

        $(function(){
            $("#url2").click(function(){
                $(this).select();
                document.execCommand('copy');
            })

        })
      </script>   
    
    

    <?php
       // echo"PREÇO ATUAL:" . $resultado->price ;
        $Valor = $resultado->price;
        $valorcerto = number_format ($Valor, 2, ',', '.');
    ?>

<br>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Preço Atual</span>
      <input type="text" class="form-control" id="url3" value=<?php echo $valorcerto ?> aria-label="Username" aria-describedby="basic-addon1">
    </div>

    
        <script>

          $(function(){
              $("#url3").click(function(){
                  $(this).select();
                  document.execCommand('copy');
              })

          })
        </script>  

   
          
    

    <?php
       // echo"PREÇO BASE:" . $resultado->base_price;

       $ValorBase = $resultado->base_price;
        $valorBasecerto = number_format ($ValorBase, 2, ',', '.');
    ?>

    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Preço Base</span>
      <input type="text" class="form-control"  id="url4" value=<?php echo $valorBasecerto ?> aria-label="Username" aria-describedby="basic-addon1">
    </div>


    
        <script>

          $(function(){
              $("#url4").click(function(){
                  $(this).select();
                  document.execCommand('copy');
              })

          })
        </script> 
    

 
    

      <?php

       $x = 6;
       $y = 10;
      foreach ($resultado ->variations as $ator) {

          $x++; 
          $y++;


         // echo "ID: " . $ator->id;
          ?>

          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">ID <?php echo $ator->attribute_combinations[0]->value_name; ?> </span>
            <input type="text" class="form-control" id=<?php echo"url".$x; ?> value=<?php echo $ator->id; ?> aria-label="Username" aria-describedby="basic-addon1">
          </div>


         
              <script>

              $(function(){
                  $(<?php echo'url'.$x ?>).click(function(){
                      $(this).select();
                      document.execCommand('copy');
                  })

              })
              </script>   
         
         


          

          <?php
         // echo "COR: " . $ator->attribute_combinations[0]->value_name;
          ?>


        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Cor</span>
          <input type="text" class="form-control" id=<?php echo"url".$y; ?> value=<?php echo $ator->attribute_combinations[0]->value_name; ?> aria-label="Username" aria-describedby="basic-addon1">
        </div>

        
                    <script>

                    $(function(){
                        $(<?php echo'url'.$y ?>).click(function(){
                            $(this).select();
                            document.execCommand('copy');
                        })

                    })
                    </script>   
          
               
        
          <?php
      }
      
  
      ?>



      
    <form action="index.php">
    <button  type="submit" class="btn btn-warning mb-3">VOLTAR</button>
    </form>     
    </div>

    <div class="col">
    </div>


  </div>
        


     
    </body>
</html>