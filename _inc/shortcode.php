<?php
function sh_random_sentence(){
	return random_sentence();
}
add_shortcode('random_sentence','sh_random_sentence');
