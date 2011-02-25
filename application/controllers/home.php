<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
        if(config_item('is_production'))
            $this->output->cache(5);

        $this->load->spark('gravatar-helper/1.1');
        $this->load->helper('gravatar');

		$this->load->view('home/index');
	}
	
	function version2()
	{
		$this->load->view('home/version2');
	}

    function set_up()
    {
        $this->load->view('home/set_up');
    }

    function get_sparks()
    {
        $this->load->view('home/get_sparks');
    }

    function make_sparks()
    {
        $this->load->view('home/make_sparks');
    }

    function about()
    {
        $this->load->view('home/about');
    }

    function download()
    {
        $this->load->model('download');
        Download::recordDownload('system');

        redirect(config_item('sparks_download_url'));
    }
	
	function contact()
	{
		$this->load->view('home/contact');
	}
	
	function privacy()
	{
		$this->load->view('home/privacy');
	}

	function project()
	{
		$this->load->spark('gravatar-helper/1.1');
		$this->load->helper('gravatar');
		
		$this->load->view('home/project');
	}

    /**
     * The installation script
     */
    function go_sparks()
    {
        $this->load->view('home/go_sparks');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */