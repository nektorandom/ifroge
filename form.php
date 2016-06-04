<?php
    
    include 'function.php';
    
    switch ($_REQUEST['action']) {
        case 'list':
            include 'connect_bd.php';
            
            ShowTreeList(0, 0); 
            
            $dbh = null;
            
            break;
        case 'list_option':
            include 'connect_bd.php';
            echo '<option selected >Выберите родителя</option>';
            
            ShowParent();
            
            $dbh = null;
            
            break;
        case 'list_option_delete':
            include 'connect_bd.php';
            echo '<option selected >Выберите имя для удаления</option>';
            
            ShowTreeSelect(0, 0); 
            
            $dbh = null;
            
            break;
        case 'form_id2':
            include 'connect_bd.php';
            
            $name = $_POST['name'];
            
            $dbh->exec("insert into `table` (name, parent_id) values ('$name', 0)");
            
            unset ($name);
            
            ShowTreeList(0, 0); 
            
            $dbh = null;
            
            break;
        case 'form_id3':
            include 'connect_bd.php';
            
            $name = $_POST['name'];
            $parentId = $_POST['selectParent'];
            
            $dbh->exec("insert into `table` (name, parent_id) values ('$name', '$parentId')");
            
            unset ($name);
            unset ($parentId);
            
            ShowTreeList(0, 0); 
            
            $dbh = null;
            
            break;
        case 'remove_parent':
            include 'connect_bd.php';
            
            $name_remove = $_POST["get_name"];
            $id_remove = $_POST["get_id"];
            
            $dbh->exec("DELETE FROM `table` WHERE `parent_id`= '$id_remove' ");
            $dbh->exec("DELETE FROM `table` WHERE `name`= '$name_remove' AND `id`= '$id_remove' ");
            
            //$json = array( "name" => 'Andrew' );
            
            header("Content-Type: application/json", true);
            echo json_encode('Запись удалена');
            
            $dbh = null;
            
            break;
        case 'remove_child':
            include 'connect_bd.php';
            
            $name_remove = $_POST["get_name"];
            $id_remove = $_POST["get_id"];
            
            $dbh->exec("DELETE FROM `table` WHERE `name`= '$name_remove' AND `id`= '$id_remove'");
            
            header("Content-Type: application/json", true);
            echo json_encode('Запись удалена');
            
            $dbh = null;
            
            break;
    
    }
    
    

?>