<?php

//Clean String Values
function clean ($string)
{
   // return htmlentities($string);
}

//Redirection
function redirect($location)
{
    return header("location:$location");
}

//Set Session Message

function set_message($msg)
{
    if(!empty($msg)) {
        $_SESSION['Message'] = $msg;
    }
    else
    {
        $msg ="";
    }
}

// Display Message Function
function display_message()
{
   if (isset($_SESSION['Message'])) {
        echo $_SESSION['Message'];
        unset($_SESSION['Message']);
   }
}


////////////////////////////////////////////////// TODO/////////////////////////
// **********************************************************************************

function save()
{
    if (isset($_POST['save'])) {
        if (isset($_POST['task'])) {
        $IdTitle = $_SESSION['id_todo'];
        $Task = $_POST['task'];
        
        global $cnn;
        $requete = $cnn->prepare('INSERT INTO Todo (Task, IdTitle) VALUES(?,?)');
        $requete->execute(array($Task, $IdTitle));
        }
    }
    if(isset($_POST['deltitle'])) {
        $IdTitle = $_SESSION['id_todo'];
        global $cnn;
        echo($IdTitle);
        $requete = $cnn->prepare('DELETE from Title where Id = :Id');
        $requete->execute(array(":Id" => $_SESSION['id_todo']));

    }
     display_task();
}

function display_task2()
{
    global $cnn;
    $requete2 = $cnn->prepare('SELECT * from Todo where IdTitle = :IdTitle');
    $requete2->execute(array(":IdTitle" => $_SESSION['id_todo']));
    while ($donnees = $requete2->fetch()) {
        echo '
    <tr>
       <td><button id="square"><i class="far fa-square"></i> </button>
                    <button id="check"><i class="fas fa-check-square" ></i></button>
                </td>
                <td   id="to_do_text">'.$donnees['Task'].'</td>
                <td id="options">
                   <a href="todo.php?Id='.$donnees['Id'].'&act=edit" name="edit"><i class="far fa-edit"></i></a>
                   <a href="todo.php?Id='.$donnees['Id'].'&act=delete"name="delete"><i class="far fa-trash-alt"></i></a>
        </td>
       </tr>
       ';
    }
}

function display_task()
{
    if (isset($_SESSION['id_todo'])) {
    global $cnn;
    $requete = $cnn->prepare('SELECT * from Title where Id = :Id');
    $requete->execute(array(":Id" => $_SESSION['id_todo']));
    while ($donnees = $requete->fetch()) {
echo '   
        <thead>
        <tr>
        <th></th>
        <th>'.$donnees['Title'].'</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        '.
        display_task2().'
        </tbody>
       ';
            }
    }
}


function display_title() {
    global $cnn;
    $requete = $cnn->prepare('SELECT * from Title where IdUser = :Uid');
    $requete->execute(array(":Uid" => "1"));
    echo '<div class="row">';
    while ($donnees = $requete->fetch()) {
        echo'<div class="col-sm-5 mb-5 ms-5 mt-5">
        <form  method="post">
        <div class="card">
          <div class="card-body">
          <button type="submit" class="btn btn-danger position-absolute top-0 end-0 m-3" name="deltitle">X</button>
            <h5 class="card-title mx-4">'.$donnees['Title'].'</h5>
            <button type="submit" class="btn btn-primary mx-4 mt-3" name="todo_page">View</button>
            <input type="hidden" name="id_todo" value="'.$donnees['Id'].'">
          </div>
        </div>
      </div>
      </form>';
               }
        echo '</div>';

}

function new_todo() {
    if (isset($_POST['save'])) {
        if (isset($_POST['title_todo'])) {
            $Uid = "1";
            $Title = $_POST['title_todo'];
            global $cnn;
            $requete = $cnn->prepare('INSERT INTO Title (Title, IdUser) VALUES(?,?)');
        $requete->execute(array($Title, $Uid));
        display_title();
           }
    } else {
        display_title();
    }
    if (isset($_POST['todo_page'])) {
        $_SESSION['id_todo'] = $_POST['id_todo'];
         redirect('todo.php');
    }
    if (isset($_POST['deltitle'])) {
        $_SESSION['id_todo'] = $_POST['id_todo'];
        global $cnn;
        $requete = $cnn->prepare('DELETE from Title where Id = :Id');
        $requete->execute(array(":Id" => $_SESSION['id_todo']));
        redirect("index.php");
    }
}

function actions() {
    if (isset($_GET['Id'])) {
        $Id = $_GET['Id'];
        if (isset($_GET['act'])) {
            if($_GET['act'] == "delete") {
        global $cnn;
            $requete = $cnn->prepare('DELETE from Todo where IdTitle = :IdTitle and Id = :Id');
        $requete->execute(array(":IdTitle" => $_SESSION['id_todo'], ":Id" => $Id));
        global $cnn;
        $requete = $cnn->prepare('SELECT * from Todo where idTitle = :IdTitle');
        $requete->execute(array(":IdTitle" => $_SESSION['id_todo']));
        $count_line = $requete->rowCount();
        if ($count_line == 0 ) {
            global $cnn;
              $requete = $cnn->prepare('DELETE from Title where Id = :Id');
            $requete->execute(array(":Id" => $_SESSION['id_todo']));
            redirect('index.php');
        }
        
    }
    if($_GET['act'] == "edit") {
        global $cnn;
        $requete = $cnn->prepare('SELECT Task from Todo where Id = :Id');
        $requete->execute(array(":Id"=>$Id));
        while ($donnees = $requete->fetch()) {
       echo '<form id="edit_form" method="post">
        <input name="task_edit" type="text" value="'.$donnees['Task'].'">
    <button name ="save_edit" type="submit" class="btn btn-primary">Save</button>
    </form>';
        }
        if(isset($_POST['save_edit'])) {
        $Task = $_POST['task_edit'];
        
        global $cnn;
        $requete = $cnn->prepare('UPDATE Todo set Task = :Task where Id = :Id');
        $requete->execute(array(":Task" => $Task, ":Id" => $Id));
        redirect('todo.php');
        }
    }
}
}
}

?>
