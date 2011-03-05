<?php
/**
 * This file contains a controller for handling contributors
 */

/**
 * The controller for contributors
 */
class Contributors extends CI_Controller
{
    /**
     * Called for the login page
     */
    public function login()
    {
        // $submit = $this->input->post('submit');

        if ($_POST)
        {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');

            $this->load->model('contributor');

            $contributor = Contributor::getByLogin($email, $password);

            if($contributor)
            {
                UserHelper::setLoggedIn($contributor);
                UserHelper::setNotice("Sup, {$contributor->real_name}?");

                UtilityHelper::handleRedirectIfNeeded();

                redirect(base_url() . 'contributors/' . $contributor->username . '/profile');
            }
            else
            {
                UserHelper::setNotice("Whoops, your login failed! Try again.");
            }
        }

        $this->load->view('contributors/login');
    }

    /**
     * Called to logout
     */
    public function logout()
    {
        UserHelper::logout();
        #UserHelper::setNotice("You've been logged out");
        redirect(base_url());
    }

    /**
     * Called to register
     */
    public function register()
    {
        $this->load->spark('robot-helper/1.1');
        $this->load->helper('robot');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $submit = $this->input->post('submit');

        if($submit)
        {
            if($this->form_validation->run('registration'))
            {
                $this->load->model('contributor');
                $insert = elements(array('username', 'email', 'real_name', 'password', 'website'), $_POST);

                if(Contributor::insert($insert))
                {
                    UserHelper::setNotice("Yay! Start contributing sparks!");
                    UserHelper::setLoggedIn(Contributor::findByUsername($insert['username']));
                    UtilityHelper::handleRedirectIfNeeded();

                    redirect(base_url() . 'contributors/' . $insert['username'] . '/profile');
                }
                else
                {
                    UserHelper::setNotice("Whoa. That didn't work. Sorry?", FALSE);
                }
            }
            else
            {
                UserHelper::setNotice('Whoops. There were some errors. Check below and re-submit!');
            }
        }

        list($question, $answer) = get_spam_check();
       
        $data['spam_question'] = $question;
        $data['spam_answer']   = $answer;

        $this->load->view('contributors/register', $data);
    }

    /**
     * Called to load (render) a profile for a user
     * @param string $username The username to load
     */
    public function profile($username)
    {
        $this->load->model('contributor');

        $data['contributor']   = Contributor::findByUsername($username);
        $data['contributions'] = $data['contributor']->getContributions();

        $this->load->view('contributors/profile', $data);
    }

    /**
     * Called when to show the edit page for a user's profile. Works of the current
     *  logged in user
     */
    public function edit()
    {
        $this->load->model('contributor');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $contributor_id = UserHelper::getId();
        $contributor    = Contributor::findById($contributor_id);
        $submit         = $this->input->post('submit');

        if($submit)
        {
            if($this->form_validation->run('edit_profile'))
            {
                $update = elements(array('email', 'website', 'real_name', 'password'), $_POST);
                Contributor::update($contributor_id, $update);

                if($update['password'])
                    UserHelper::setNotice("Nice, everything saved, including your new password");
                else
                    UserHelper::setNotice("Nice, everything saved");
            }
            else
            {
                UserHelper::setNotice("Hrm, there was a problem (see below)", FALSE);
            }
        }

        $data = array (
            'contributor' => $contributor
        );

        $this->load->view('contributors/edit', $data);
    }

    /**
     * A CodeIgniter validation callback for checking to see the the anti-spam
     *  robot check was correct
     * @param string $answer The submitted value
     * @return bool True if validation passed, false if not
     */
    public function robot_check($answer)
    {
        $this->load->library('form_validation');

        if(spam_check_answer($answer)) return true;

        $this->form_validation->set_message('robot_check', 'The robot check was wrong. hrmm.');
        return FALSE;
    }

    /**
     * An ajax call to get the current logged-in-user's profile page when logged in.
     * Loaded via ajax so the front page can be cached easily
     * @todo Remove the markup and return JSON. Also, refactor to a dedicated ajax controller
     */
	public function get_profile_info()
	{
        if(UserHelper::isLoggedIn())
        {
            $html  = '<div class="profile-image">';
            $html .= '<a href="/contributors/profile/'.UserHelper::getUsername().'" title="View Your Profile">';
            $html .= '<img src="'.UserHelper::getAvatarURL(80).'" alt="Gravatar" />';
            $html .= '</a>';
            $html .= '</div>';
            $html .= '<div class="profile-links">';
            $html .= '<dl>';
            $html .= '<dd><a href="/contributors/profile/'.UserHelper::getUsername().'" title="View Your Profile">View Your Profile</a></dd>';
            $html .= '<dd><a href="/contributors/'.UserHelper::getUsername().'/profile/edit" title="Update Your Profile">Update Your Profile</a></dd>';
            $html .= '<dd><a href="/packages/add" title="Create a Spark">Create a Spark</a></dd>';
            $html .= '<dd class="last"><a href="/logout" title="Logout">Logout</a></dd>';
            $html .= '</dl>';
            $html .= '</div>';
        }
        else
        {
			$html  = '<form action="/login" method="post">';
            $html .= '<fieldset>';
            $html .= '<label for="email">Email Address:</label><br class="clear" />';
			$html .= '<input type="text" id="email" name="email" class="text-box" /><br class="clear" />';
			$html .= '<label for="password">Password:</label><br class="clear" />';
			$html .= '<input type="password" id="password" name="password" class="text-box" /><br class="clear" />';
            $html .= '<input type="submit" id="submit" class="submit" value="Login">';
			$html .= '</fieldset>';
			$html .= '</form>';
        }
		
		$this->output->set_output($html);
	}
}