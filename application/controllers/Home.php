<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url','html');


	}
	public function index()
	{
		//decode file json dalam folder assets/json
	  $file = 'assets/json/corona.json';
      $req=file_get_contents($file);
      $get_json=json_decode($req,true);
      	//decode api data dari kawalcorona.com
	  $url2="https://api.kawalcorona.com/";
      $req2=file_get_contents($url2);
      $get_json2 = json_decode($req2,true);
	  

      foreach ($get_json2 as $key => $d) {
    
    	// Mengambil data api kawalcorona.com 	
	    if ($d['attributes']['Country_Region'] === 'Indonesia') {

	       $terjangkit_baru = $get_json2[$key]['attributes']['Confirmed'];
           $perawatan_baru = $get_json2[$key]['attributes']['Active'];
           $sembuh_baru = $get_json2[$key]['attributes']['Recovered'];
           $meninggal_baru = $get_json2[$key]['attributes']['Deaths'];
           $update_baru = $get_json2[$key]['attributes']['Last_Update'];

			    }
	  }

	  foreach ($get_json as $key => $d) {
    
    	// Perbarui data json dalam folder assets/json	
	    if ($d['attributes']['Country_Region'] === 'Indonesia') {

	       $get_json[$key]['attributes']['Confirmed'] = $terjangkit_baru;
           $get_json[$key]['attributes']['Active'] = $perawatan_baru ;
           $get_json[$key]['attributes']['Recovered'] = $sembuh_baru;
           $get_json[$key]['attributes']['Deaths'] = $meninggal_baru;
           $get_json[$key]['attributes']['Last_Update'] = $update_baru;

			    }
	  }
		// Mengencode data yang sudah di olah di atas menjadi json
		$jsonfile = json_encode($get_json, JSON_PRETTY_PRINT);

		// Menyimpan data ke dalam file json dalam folder assets/json
		$req = file_put_contents($file, $jsonfile);

		//decode file json dalam folder assets/json
	  $file1= "assets/json/corona_indo.json";
      $req1=file_get_contents($file1);
      $get_json1=json_decode($req1,true);

    	//decode file json dari kawalcorona.com
      $url3="https://api.kawalcorona.com/indonesia/provinsi/";
      $req3=file_get_contents($url3);
      $get_json3 = json_decode($req3,true);
	  
	  for($i=0;$i<count($get_json1);$i++){
	  			//memperbarui data dari file assets/json dengan data baru dari kawalcorona.com
                $get_json1[$i]['attributes']['Provinsi'] = $get_json3[$i]['attributes']['Provinsi'];
                $get_json1[$i]['attributes']['Kasus_Posi'] = $get_json3[$i]['attributes']['Kasus_Posi'];
                $get_json1[$i]['attributes']['Kasus_Semb'] = $get_json3[$i]['attributes']['Kasus_Semb'];
                $get_json1[$i]['attributes']['Kasus_Meni'] = $get_json3[$i]['attributes']['Kasus_Meni'];
              }

              // Mengencode data menjadi json
		$jsonfile1 = json_encode($get_json1, JSON_PRETTY_PRINT);

		// Menyimpan atau memperbaharui data di folder assets/json
		$req1 = file_put_contents($file1, $jsonfile1);
      
      redirect('Home/halaman_awal','refresh');

	}


	public function halaman_awal()
	{
		$this->load->view('v_header');
		$this->load->view('v_home');
		$this->load->view('v_footer');
	}


	public function call_center()
	{
		$this->load->view('v_header');
		$this->load->view('v_call-center');
		$this->load->view('v_footer');
	}
	public function gejala()
	{
		$this->load->view('v_header');
		$this->load->view('v_gejala');
		$this->load->view('v_footer');
	}
	public function pencegahan()
	{
	
		$this->load->view('v_header');
		$this->load->view('v_pencegahan');
		$this->load->view('v_footer');
	}
}
