<?php

class VoteModel
{
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

	public function hasVoted($user_ip, $image_id)
	{
		$sql = "SELECT COUNT(*) AS votes " .
			   "  FROM dv_votes " .
			   " WHERE user_ip = :user_ip " .
			   "   AND image_id = :image_id";

        $query = $this->db->prepare($sql);
        $query->execute(array(':user_ip' => $user_ip, ':image_id' => $image_id));

		$votes = $query->fetch()->votes;

		return $votes > 0;
	}

    public function registerVote($user_ip, $image_id, $up_or_down)
    {
        $sql = "INSERT INTO dv_votes " .
			   "    (`user_ip`, `image_id`, `up_or_down`, `vote_date`) " .
			   " VALUES " .
			   "    (:user_ip, :image_id, :up_or_down, NOW() )";

        $query = $this->db->prepare($sql);
		$query->bindValue(':user_ip', $user_ip, PDO::PARAM_STR);
		$query->bindValue(':image_id', $image_id, PDO::PARAM_INT);
		$query->bindValue(':up_or_down', $up_or_down ? 0 : 1, PDO::PARAM_INT);

        $query->execute();
    }
}
