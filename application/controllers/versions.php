<?php
/**
 * The file contains a controller for dealing with versions
 */

/**
 * This is a controller for handling adding and removing of versions
 */
class Versions extends CI_Controller
{
    /**
     * The POST call to add a version to a package
     *  Redirect to the package page on success
     */
    public function add()
    {
        $submit = $this->input->post('submit');

        if($submit)
        {
            $this->load->library('form_validation');
            $this->load->model('version');
            $this->load->model('spark');
            
            $insert = elements(array('spark_id', 'tag'), $_POST);

            if($this->form_validation->run('add-version'))
            {
                if(Version::insert($insert))
                {
                    UserHelper::setNotice("Version added!");
                }
            }
            else
            {
                UserHelper::setNotice("Try to enter a valid tag!", FALSE);
            }

            $spark = Spark::getById($insert['spark_id']);
            redirect(base_url() . 'packages/' . $spark->name . '/show');
        }

        show_error("Whatcha doin' here?");
    }
}