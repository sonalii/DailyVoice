<?php


class Vote extends Controller
{
    public function index()
    {
        echo 'nothing to do';
    }

    public function register($type, $id)
    {
		$id    = intval($id);
		$type  = strtolower($type);
		$is_up = ($type == 'up');

		$vote_model = $this->loadModel('VoteModel');
		$img_model  = $this->loadModel('ImageModel');

		// register the vote
		$vote_model->registerVote($this->getUserIP(), $id, $is_up);

		// update vote count
		if ($is_up) {
			$img_model->vote($id, 1, 0);
		} else {
			$img_model->vote($id, 0, 1);
		}

		$img_data  = $img_model->getImage($id);
		$has_voted = true;

		//header('Content-Type: application/json');
		//echo json_encode($updated_img);

		require 'app/views/home/voter.php';
    }
}
