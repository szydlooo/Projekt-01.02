<?php
class Liked {

    static function likeAdd($userId, $postID) {
        global $db;
        
        $query1 = $db->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ?");
        $query1->bind_param('ii', $postID, $userId);
        $query1->execute();
        $result = $query1->get_result();
        $query4 = $db->prepare("SELECT * FROM disliked WHERE post_id = ? AND user_id = ?");

        $query4->bind_param('ii', $postID, $userId);
        $query4->execute();
        $result2 = $query4->get_result();
            // Ma się równać 0, gdyż jak się równa 1 to oznacza, że już użytkownik polubił to zdjęcie.
        if (mysqli_num_rows($result) == 0) { 
            // Dodaje polubienie do bazy danych
            $query2 = $db->prepare("UPDATE post SET liked = liked + 1 WHERE id = ?");
            $query2->bind_param('i', $postID);
            $query2->execute();
            
            // Dodaje fakt, że użytkownik dodał polubienie do bazy danych
            $query3 = $db->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
            $query3->bind_param('ii', $postID, $userId);
            $query3->execute();
        }
        elseif(mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 1) {
                        // Dodaje polubienie do bazy danych
                        $query2 = $db->prepare("UPDATE post SET liked = liked + 1 WHERE id = ?");
                        $query2->bind_param('i', $postID);
                        $query2->execute();
                        
                        // Dodaje fakt, że użytkownik dodał polubienie do bazy danych
                        $query3 = $db->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
                        $query3->bind_param('ii', $postID, $userId);
                        $query3->execute();

                        $query5 = $db->prepare("DELETE FROM disliked WHERE user_id = ? AND post_id = ?");
                        $query5->bind_param('ii',$userId, $postID);
                        $query5->execute();
            

        }
        elseif(mysqli_num_rows($result) == 1) {
            // bez tego nie działa, nie ruszać!!!!
        }
        elseif(mysqli_num_rows($result) == 1 && mysqli_num_rows($result2) == 1) {
            die("coś zjebałeś i nagle użytkownik polubił i odpolubił zdjęcie");
        }
        
    }
    static function likeDelete($userId, $postID) {
        global $db;

        $query1 = $db->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ?");
        $query1->bind_param('ii', $postID, $userId);
        $query1->execute();
        $result = $query1->get_result();
        $query4 = $db->prepare("SELECT * FROM disliked WHERE post_id = ? AND user_id = ?");
        $query4->bind_param('ii', $postID, $userId);
        $query4->execute();
        $result2 = $query4->get_result();
        if (mysqli_num_rows($result) == 1) { 
            $query2 = $db->prepare("UPDATE post SET liked = liked - 1 WHERE id = ?");
            $query2->bind_param('i', $postID);
            $query2->execute();

            $query3 = $db->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
            $query3->bind_param('ii',$userId, $postID);
            $query3->execute();
            $query5 = $db->prepare("INSERT INTO disliked (post_id, user_id) VALUES (?, ?)");
            $query5->bind_param('ii', $postID, $userId);
            $query5->execute();
        }
        elseif(mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 0) {
            $query2 = $db->prepare("UPDATE post SET liked = liked - 1 WHERE id = ?");
            $query2->bind_param('i', $postID);
            $query2->execute();

            $query3 = $db->prepare("INSERT INTO disliked (post_id, user_id) VALUES (?, ?)");
            $query3->bind_param('ii', $postID, $userId);
            $query3->execute();

        }
        elseif(mysqli_num_rows($result) == 1 && mysqli_num_rows($result2) == 0) {
            $query2 = $db->prepare("UPDATE post SET liked = liked - 1 WHERE id = ?");
            $query2->bind_param('i', $postID);
            $query2->execute();

            $query4 = $db->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
            $query4->bind_param('ii',$userId, $postID);
            $query4->execute();


            $query3 = $db->prepare("INSERT INTO disliked (post_id, user_id) VALUES (?, ?)");
            $query3->bind_param('ii', $postID, $userId);
            $query3->execute();

        }
        

    }



    
   
    



}
?>