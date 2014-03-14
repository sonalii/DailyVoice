<?php

class ImageModel
{
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getMaxImageId()
    {
        $sql  = "SELECT max(id) AS max_id FROM dv_images ";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->max_id;
    }

    public function getImage($id)
    {
        $sql  = "SELECT id, title, url, likes, dislikes, last_modify_dt " .
			    "  FROM dv_images " .
			    " WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }

    public function vote($id, $up, $down)
    {
        $sql = "UPDATE dv_images " .
			   "   SET likes = likes + :up, " .
			   "       dislikes = dislikes + :down, " .
			   "       last_modify_dt = NOW() " .
			   " WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->execute(array(':up' => $up, ':down' => $down, ':id' => $id));
    }
}
