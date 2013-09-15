<!doctype html>
<html>
    <head>
        <title>webkitdirectory Experiment</title>
    
        <style>
            body {
                text-align:center;
                background-color:#DEF3FE;
                font-family:Arial, Helvetica, sans-serif;
                font-size:80%;
                color:#666;
                margin: 0;
                padding:0;
            }
            .File_Upload_Form {
                width:600px;
                margin:30px auto;
                background-color:#FFF;
                border-radius:4px;
                padding: 4px 20px 20px 20px;
            }
            h1 {
                font-family:Georgia, "Times New Roman", Times, serif;
                font-size:170%;
                color:#645348;
                font-style:italic;
                text-decoration:none;
                font-weight:100;
            }	
            input[type="submit"]{
                border:1px solid #917568;
                border-radius: 4px;
                margin:0;
                padding:4px 10px 4px 10px;
                font-family:Georgia, "Times New Roman", Times, serif;
                font-size:14px;
                font-style:italic;
                color:#333333;
                text-shadow:1px 1px 0 #fff;
                background-color:#A5B276;
                background-image: -webkit-linear-gradient(#CED8AF, #A5B276);
                background-image: -moz-linear-gradient(center bottom , #A5B276 0%, #727E47 100%); 
                background-size:1px 50px;  
                padding: 5px;
                cursor:pointer;
                -webkit-transition: background .5s ease-out; 
            }
            input[type="submit"]:Hover,:focus{  
                background-position:100px;  
            }  
        </style>
    </head>
    
    <body>
        <div class="File_Upload_Form">
        <h1>Basic Folder Upload Script!</h1>
        
        <form enctype="multipart/form-data" id="upForm">
            <input type="file" name="file_input[]" id="file_input" multiple webkitdirectory="" directory="" mozdirectory>
            <input type="submit" value="Upload File" />
        </form>
        </div> 
    </body>
</html>