<?php

class Home extends Controller
{

	public function index()
    {
        $this->image(1);
    }

	public function image($id)
	{
		$img_model  = $this->loadModel('ImageModel');
		$vote_model = $this->loadModel('VoteModel');

		$id         = intval($id);
		$img_max_id = $img_model->getMaxImageId();
		$img_data   = $img_model->getImage($id);
		$has_voted  = $vote_model->hasVoted($this->getUserIP(), $id);

		$prev_id   = (($id <= 1) ? $img_max_id : $id - 1);
		$next_id   = (($id == $img_max_id) ? 1 : $id + 1);

        require 'app/views/_templates/header.php';
        require 'app/views/home/image.php';
        require 'app/views/_templates/footer.php';
	}
}
