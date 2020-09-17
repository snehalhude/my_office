<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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


	/*Author : Snehal Hude
	Function : This function load employee list page 
	Date : 12-09-2020
	*/
	
	public function index()
	{   
		//UNSET SESSION IF DEFINED
		
		if(isset($_SESSION['edit'])){
		$this->session->unset_userdata('edit');

		}
		
		$getEmployees 		= 	$this->Common_model->getData('employees','','','id desc');
	
		$data 				= 	array(
		
			'title'	  		=> "Employees List",
			'add_btn' 		=> "Add New Employee",
			'add_url' 		=> 	site_url('add-employee'),
			'export_btn' 	=> "Export To Excel",
			'export_url' 	=> 	site_url('export-to-excel'),
			'getEmployees' 	=>	$getEmployees,
			
		);

		$this->load->view('employee/list',$data);
	}

	/*Author : Snehal Hude
	Function : This function load employee view page 
	Date : 12-09-2020
	*/
	public function view($id='')
	{
		$row 			= 	$this->Common_model->getData('employees',"",'id="'.$id.'"');

		
		$data 			= array(
		
			'title'	  		=> 	"View Employee",
			'back_url' 		=> 	site_url('employee-list'),
			'back_title' 	=> 	"Employees List",
			'id' 			=>	$row[0]->id,
			'emp_id' 	    =>	$row[0]->emp_id,
			'name' 			=>	$row[0]->name,
			'email' 		=>	$row[0]->email,
			'phone' 		=>	$row[0]->phone,
			'status' 		=>	$row[0]->status,
		); 

		$this->load->view('employee/view',$data);
	}

	/*Author : Snehal Hude
	Function : This function load  ad employee form page 
	Date : 12-09-2020
	*/
	public function add()
	{  
		
		$this->load->view('employee/form');
	}

	/*Author : Snehal Hude
	Function : This function perform  add employee to the database and checks validtions
	Date : 12-09-2020
	*/
	public function add_action()
	{	 	

		
		//CALL THE VALIDATIONS RULES
		$rules = $this->_rules();

		if ($this->form_validation->run() == FALSE)
		{  
			
			$this->load->view('employee/form'); 
		}
		else
		{  

			$data = array(
	    	'name' 		=> $this->input->post('name'),
	    	'email' 	=> $this->input->post('email'),
	    	'phone' 	=> $this->input->post('phone'),
	    	'created' 	=> date('Y-m-d h:i:s'),
	    	 );

		    $this->Common_model->save("employees",'',$data);

		    $emp_id = $this->db->insert_id();

		    //GENERATE UNIQUE EMPLOYEE ID
		    $employee_id = "mo_10".$emp_id;

		    $data['emp_id'] = $employee_id ;

		    //SAVE EMPLOYEE ID
		    $this->Common_model->save("employees",'id="'.$emp_id.'"',$data);

		    $this->session->set_flashdata('success_msg', '<div class="success">Employee has been created successfully.</div>');

		    redirect('employee-list');



		}
		  

	}

	/*Author : Snehal Hude
	Function : This function perform  loads employee edit page with data 
	Date : 12-09-2020
	*/

	public function edit($id)
	{	
		$row 		  = 	$this->Common_model->getData('employees','',"id='".$id."'");
	
		
		$data 		  = 	array(
			'title'	  		=> "Edit Employee",
			'button'		=> "Edit",
			'back_url' 		=> site_url('employee-list'),
			'back_title' 	=> "Employees List",
			'action_url' 	=> site_url('Employee/edit_action'),
			'id' 			=> set_value('id',$row['0']->id),
			'emp_id' 	    => set_value('id',$row['0']->emp_id),
			'name' 			=> set_value('name',$row['0']->name),
			'email' 		=> set_value('price',$row['0']->email),
			'phone' 		=> set_value('quantity',$row['0']->phone),

		);

		$this->load->view('employee/edit_form',$data);
		
	}

	/*Author : Snehal Hude
	Function : This function perform  edit employee  and checks validations
	Date : 12-09-2020
	*/

	public function edit_action()
	{
		
		$rules = $this->_rules();

		if ($this->form_validation->run() == FALSE)
		{  
			$data['edit'] = array (
            'errors' => validation_errors(),
	        );
	        $this->session->set_userdata($data);
	    
			redirect('edit-employee/'.$this->input->post('id'));
		}
		else
		{  
			 $data = array(
	    	'name' 		=> $this->input->post('name'),
	    	'email' 	=> $this->input->post('email'),
	    	'phone' 	=> $this->input->post('phone'),
	    	'created' 	=> date('Y-m-d h:i:s'),
	    	 );

		    $this->Common_model->save("employees",'id="'.$this->input->post('id').'"',$data);
		    $this->session->set_flashdata('success_msg', '<div class="success">Employee has been edited successfully.</div>');

		   redirect('employee-list');

		}
	}

	
	/*Author : Snehal Hude
	Function : This function perform to change status of employee
	Date : 12-09-2020
	*/
	public function change_status($status,$id)
	{
		if($status == '1'){
			$data = array('status'=> '0');
		}else{
			$data = array('status'=> '1');
		}
        $this->Common_model->save("employees",'id="'.$id.'"',$data);
		$this->session->set_flashdata('success_msg', '<div class="success">Employee status has been changed successfully.</div>');
		redirect('employee-list');
	}



	/*Author : Snehal Hude
	Function : This function to export employees details to excel sheet
	Date : 12-09-2020
	*/
	public function export()
	{
		// create file name
        $fileName = 'Employees_List-'.date('y-m-d-h-i-s').'.xlsx';  
    	// load excel library
        $this->load->library('excel');
        $employees_data = $this->Common_model->getData('employees','','','name asc');

        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Employee ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Phone No');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Status');       
        // set Row
        $rowCount = 2;
        foreach ($employees_data as $row) {
        	if($row->status == '1'){ $status = 'Active';  } else { $status = 'Inactive'; }
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row->emp_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, ucwords($row->name));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row->phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $status);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(getcwd()."/uploads/employees/".$fileName);
    // download file
        header("Content-Type: application/vnd.ms-excel");
         redirect(base_url('/uploads/employees/').$fileName); 
       
	}






	/*Author : Snehal Hude
	Function : This function set validations for add and edit employees
	Date : 12-09-2020
	*/

   public function _rules()
   {
   	  $this->form_validation->set_rules(
	        'name', 'Name', 'required|regex_match[/^[a-zA-Z ]{2,30}$/]',
	        array(
	                'required'      => '%s Required.',
	                'regex_match'      => 'Invalid %s.',
	               
	        )
			);



   	   if($this->input->post('button') == 'Add'){

   	   	 $this->form_validation->set_rules( 'email', 'Email','required|valid_email|is_unique[employees.email]',
	        array(
	                'required'      =>  '%s Required',
	                'valid_email'   => 'Invalid %s.',
	                'is_unique'     => 'This %s already exists.'
	        )
			); 

   	   }
   	   else{
   	   	$check_email = $this->Common_model->getData('employees','id,email','email="'.$this->input->post('email').'" and id != "'.$this->input->post('id').'"');

   	   
   	   	if(!empty($check_email)){
   	   		
   	   			$is_unique ='|is_unique[employees.email]';
   	   		}else{
   	   			$is_unique = '';
   	   		}

   	   		
   	   		 $this->form_validation->set_rules( 'email', 'Email','required|valid_email'.$is_unique,
	        array(
	                'required'      =>  '%s Required',
	                'valid_email'   => 'Invalid %s.',
	                'is_unique'     => 'This %s already exists.'
	        )
			); 

   	   	}

   	   		
		 $this->form_validation->set_rules( 'phone', 'Phone No','required|numeric|is_unique[employees.email]',
	        array(
	                'required'      => '%s Required',
	                'numeric'       => 'Invalid %s.',
	                'is_unique'     => 'This %s already exists.'
	        )
			);

		
		
	 
   }


}
