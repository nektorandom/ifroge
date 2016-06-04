<?php
    //
    function ShowTreeList($ParentID, $lvl) { 
			
        include 'connect_bd.php';
            
        global $lvl; 
        $statement = $dbh->query('SELECT * FROM `table` WHERE parent_id=' . $ParentID . ' ORDER BY name DESC');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $row) {
            $ID1 = $row["id"];
            
            if ( $ParentID == 0 ) {
                ?>
                <li style="margin-left: <?=($lvl * 25);?>px;" >
                    <span class="list-name"><?=$row['name'];?></span>
                    <input type="button" class="remove" value="Удалить родителя" data-id="<?=$ID1;?>" data-relation="parent">
                </li>
                <?php
            }
            else {
                ?>
                <li style="margin-left: <?=($lvl * 25);?>px;" data-parentId="<?=$row['parent_id'];?>">
                    <span class="list-name"><?=$row['name'];?></span>
                    <input type="button" class="remove" value="Удалить ребенка" data-id="<?=$ID1;?>" data-relation="child">
                </li>
                <?php
            }
            
            $lvl++;
            ShowTreeList($ID1, $lvl);
            $lvl--;
        }
        
    }
    
    //
    function ShowTreeSelect($ParentID, $lvlSelect) { 
			
        include 'connect_bd.php';
            
        global $lvlSelect; 
        $statement = $dbh->query('SELECT * FROM `table` WHERE parent_id=' . $ParentID . ' ORDER BY name DESC');
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $row) {
            $ID1 = $row["id"];
            
            if ( $ParentID == 0 ) {
                echo '<option data-id="' . $ID1 . '" data-relation="parent" data-name="' . $row['name'] . '">' . $row['name'] . '</option>';
            }
            else {
                echo '<option data-id="' . $ID1 . '" data-relation="child" data-name="' . $row['name'] . '">- ' . $row['name'] . '</option>';
            }
            
            $lvlSelect++;
            ShowTreeSelect($ID1, $lvlSelect);
            $lvlSelect--;
            
        }
        
    }
    
    function ShowParent() {
        
        include 'connect_bd.php';
        
        foreach($dbh->query('SELECT * FROM `table` WHERE parent_id=0 ORDER BY name DESC') as $row) {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
        
    }


?>