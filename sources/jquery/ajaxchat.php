<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajax - Chat</title>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-grid.min.css">
    <style>
        .message-zone {
            min-height: 15rem;
            max-height: 30rem;
            border: 1px solid #cccccc;
            border-radius: 5px;
            overflow: auto;
            padding: 2rem;
        }
        .message {
            padding: 0;
            margin: 0;
        }
        .message span {
            display: block;
            margin: 0;
        }
        .message .texte {
            padding: .5rem 1rem;
            border: 1px solid #5bc0de;
            background-color: #cff7ff;
            border-radius: 5px;
            font-size: .8rem;
            width: 50%;
        }
        .message .name {
            font-size: .7rem;
            color: #959595;
            margin: 0 0 0 10px;
        }
    </style>
</head>
<body>
<div class="container">
   <div class="row">
       <div class="col-md-3"></div>
       <div class="col-md-6 mt-lg-5 mb-lg-5">
           <div class="message-zone" id="message-zone"></div>
           <div class="form-zone mt-5">
               <form action="" method="post">
                   <input type="text" name="name" class="form-control mb-2" placeholder="Votre prénom" id="name">
                   <input type="text" name="msg" class="form-control" placeholder="Votre message" id="msg">
                   <input type="submit" name="send" value="Envoyer" class="btn btn-primary mt-3" id="send">
               </form>
           </div>
       </div>
       <div class="col-md-3"></div>
   </div>
</div>



<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/ajaxchat.js"></script>
</body>
</html>
