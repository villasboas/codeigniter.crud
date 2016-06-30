<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  * Controller principal da aplicação
  *
  * Responsavel pelo crud de clientes no banco de dados
  *
  * @author  Gustavo Vilas Boas
  * @since 29/06/2016
*/
class App extends CI_Controller {

	//variavel publica que guarda os dados da pagina
	public $setpage;

	 /**
	  * Construct da classe.
	  *
	  * Carrega as models, helper e library usadas no controller.
	  * Seta as variavéis padrões da view.
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param void
	  * @return void
  	*/
	public function __construct() {
		//carrega o construct da classe pai
		parent::__construct();

		//seta as variaveis de view para os valores padrões
		$this->setpage['title'] = "Página sem titulo";
		$this->setpage['view'] = "index";
		$this->setpage['success'] = FALSE;
		$this->setpage['error'] = FALSE;

		//cerrega model, library e helper utilizados no controller
		$this->load->model('app_model');
		$this->load->library(array('form_validation','upload','session','image_lib'));
		$this->load->helper('url');
		$this->load->database();
	}

	 /**
	  * Primeira página do controller
	  *
	  * Carrega os dados do banco de dados e exibe a view principal do controller
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param void
	  * @return void
  	*/
	public function index() {

		//usa a model para selecionar todos os clientes do banco de dados
		$query = $this->app_model->select_client();

		//guarda os dados na variavel setpage e carrega a view
		$this->setpage['table'] = $query;
		$this->load->view('index', $this->setpage);
	}
	
	/**
	  * Página de detalhes do cliente
	  *
	  * Seleciona um cliente especifico no banco de dados a partir do id informado
	  * e exibe os seus dados para o usuário
	  * 
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param (int) id (passado pela url)
	  * @return void
  	*/
	public function read($id) {

		//seta as variaveis de página
		$this->setpage['title'] = 'Detalhes cliente';
		$this->setpage['view'] = "read";

		//faz a pesquisa no bd a partir do id informado
		$query = $this->app_model->select_client($id);
		
		//guarda o resultado da consulta e carrega a view read
		$this->setpage['result'] = $query; 
		$this->load->view('index',$this->setpage);
	}	

	/**
	  * Página para cadastrar um novo cliente
	  *
	  * Cerrega o formulário de cadastro de clientes e guardar novas entradas no banco de dados
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param void
	  * @return void
  	*/
	public function create() {

		//seta as variaveis de página
		$this->setpage['title'] = "Adicionar cliente";
		$this->setpage['view'] = "create";

		//define as regras de validção do formulario de clientes
		$this->form_validation->set_rules("desc_nome","Nome","alpha_dashed|trim|required");
		$this->form_validation->set_rules("desc_email","E-mail","required|trim|required|valid_email|is_unique[clientes.desc_email]");
		$this->form_validation->set_rules("desc_telefone","desc_telefone", "numeric|trim|max_length[14]");
		
		//verifica se o formulario submetido é válido
		if($this->form_validation->run() !== FALSE)
		{
			//tenta fazer o upload do avatar
			$check = $this->upload();

			//verifica se o upload foi realizado
			if($check)
			{	
				//seta um array com todas as informações para o cadastro do novo cliente
				$dados['desc_nome'] = $this->input->post('desc_nome');
				$dados['desc_email'] = $this->input->post('desc_email');
				$dados['desc_telefone'] = $this->input->post('desc_telefone');
				$dados['desc_foto'] = $check;

				//tenta cadastrar o novo cliente e se conseguir define uma mensagem de sucesso
				if($this->app_model->update_client($dados))
					$this->setpage['success'] = "Cliente adicionado com sucesso"; 
			}
			else
			{	
				//caso não consiga fazer o upload seta a mensagem de erro
				$this->setpage['error'] = $this->upload->display_errors(); 
			}	
		}
		else
		{
			//caso o formulário seja invalido, seta a mensagem de erro
			$this->setpage['error'] =  validation_errors();
		}
		
		//carrega a view para adicionar um novo cliente
		$this->load->view('index',$this->setpage);
	}	

	/**
	  * Página para editar um cliente
	  *
	  * Carrega os dados de um cliente a partir do id e permite que o usuário edite-o como desejar
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param (int) id (id do cliente a ser editado, passado pela url)
	  * @return void
  	*/
	public function update($id) {

		//seta as variaveis de página
		$this->setpage['title'] = "Editar cliente";
		$this->setpage['view'] = "update";

		//seleciona o cliente informado e guarda o email submetido no formulario de edição
		$query = $this->app_model->select_client($id);
		$email = $this->input->post('desc_email');

		//verifica o email e se for diferente do que está no banco de dados, verifica se o novo email é unico
		if($email && $email != $query[0]->desc_email)	
			$this->form_validation->set_rules("desc_email","E-mail","trim|required|valid_email|is_unique[clientes.desc_email]");

		//seta as regras de validação de fomrulario
		$this->form_validation->set_rules("desc_nome","Nome","alpha_dashed|trim");	
		$this->form_validation->set_rules("desc_telefone","Telefone", "numeric|trim|max_length[14]");
		$this->form_validation->set_rules("flg_ativo","Ativo", "");


		//testa para ver se o formulario é valido
		if($this->form_validation->run() !== FALSE)
		{
			
			//carrega as informações digitadas pelo usuario e guarda em um array
			$dados['desc_nome'] = $this->input->post('desc_nome');
			$dados['desc_email'] = $this->input->post('desc_email');
			$dados['desc_telefone'] = $this->input->post('desc_telefone');
			$dados['flg_ativo'] = $this->input->post('flg_ativo');

			//verifica se algum arquivo está sendo submetido junto ao formulario
			if(isset($_FILES['desc_foto']) && $_FILES['desc_foto']['size'] > 0)
				//se o upload foi feito com sucesso, seta o novo nome da foto do avatar do usuário
				$dados['desc_foto'] = ($this->upload()) ? $this->upload() : $query[0]->desc_foto;
			//tenta dar o update no cliente
			$check = $this->app_model->update_client($dados, $id);

			//seta mensagem de erro ou succeso
			if($check)
				$this->setpage['success'] = "O cliente foi alterado com sucesso";
			else
				$this->setpage['error'] = "Houve um erro ao tentar alterar o cliente, por favor tente novamente";

		}
		else
		{
			//seta a mensagem de erro caso o formulário não for válido
			$this->setpage['error'] = validation_errors();
		}			

		//seta a view com os dados da pagina
		$this->setpage['result'] = $query; 
		$this->load->view("index", $this->setpage);

	}

	/**
	  * Página para deletar
	  *
	  *	Deleta um cliente a partir de um email especifico
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param (int) id (id do cliente a ser deletado, passado pela url)
	  * @return void
  	*/	
	public function delete($id) {

		//define as variaveis de página
		$this->setpage['title'] = "Deletar cliente";
		$this->setpage['view'] = "delete";

		//tenta deletar o cliente a partir do id
		$query = $this->app_model->delete_client($id);

		//verifica se foi deletado e seta a mensagem de sucesso
		if($query) 
			$this->setpage['success'] = 'O dado foi excluido com sucesso';
		//se não conseguiu deletar, seta a mensagem de erro
		else
			$this->setpage['error'] = 'Houve um problema ao tentar excluir o dado';

		//carrega a view de delete
		$this->load->view("index", $this->setpage);
		
	}

	/**
	  * Metodo de upload de avatar
	  *
	  *	Faz o upload do avatat do cliente
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param void
	  * @return (string) nome_do_arquivo uma string contendo o nome do arquivo em caso de sucesso do upload
	  * @return (bool) false caso não consiga fazer o upload da imagem
  	*/	
	private function upload() {

		//define o array de configuração do upload
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpg';
		$config['max_size'] = '100';
		$config['max_width'] = '1000';
		$config['max_height'] = '1000';
		$config['file_name'] = md5(uniqid(rand()*time()));

		//tenta fazer o upload
		$this->upload->initialize($config);

		//se o upload for feito, seta o tamanho da imagem para 100X100
		if($this->upload->do_upload("desc_foto"))
		{
			//configurações do resize
			$config['image_library'] = 'gd2';
		    $config['source_image'] = 'uploads/'.$config['file_name'].'.jpg';
		    $config['create_thumb'] = FALSE;
		    $config['maintain_ratio'] = FALSE;
		    $config['width'] = 100;
		    $config['height'] = 100;

		    //tenta fazer o resize
		    $this->image_lib->clear();
		    $this->image_lib->initialize($config);
		    
		    if($this->image_lib->resize())
		    	//se conseguir, retorna o nome do arquivo
		    	return $config['file_name'];
		    else
		    	//se não, retorna false
		    	return false;
		}
		else
			//volta false caso não consiga fazer o upload
			return false;
	
	}
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */