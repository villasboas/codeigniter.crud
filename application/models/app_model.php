<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
  * Model para operações com o banco de dados na tabela clientes
  *
  * faz as tarefas basicas de operações com o banco de dados na tabela clientes
  *
  * @author  Gustavo Vilas Boas
  * @since 29/06/2016
*/
class App_model extends CI_Model {


	/**
	  * Metodo para pegar dados do banco de dados
	  *
	  * Carrega os dados de um cliente no banco de dados. Se o id for informado, retorna as informações desse cliente
	  * senao, retorna todos os dados do banco
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param (int) id (id do cliente a ser editado, passado pela url)
	  * @return (array) um array com os objetos de resposta do banco
  	*/
	public function select_client($id=null) {

		//verifica se um id de cliente foi informado e seta a query de acordo com o resultado
		if($id == null)
			$query = $this->db->get("clientes");
		else
			$query = $this->db->get_where("clientes",array("cliente_id"=>(int)$id));
		
		//retorna o resultado da query
		return $query->result();

	}

	/**
	  * Adiciona ou edita um cliente
	  *
	  * Recebe um array com os dados de um cliente e adiciona ou modifica no banco de dados
	  * se um id for informado, ele atualiza os dados do bd referente a esse id
	  * caso contrário, cria uma nova entrada
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param (array) data (dados do cliente a ser cadastrado)
	  * @param (int) id (id do cliente a ser editado, passado pela url)
	  * @return false caso não consiga cadastrar no banco de dados
	  * @return true se conseguir cadastrar no banco com sucesso
  	*/
	public function update_client($data, $id=null) {

		//verifica se os dados foi informado e se não forem, retorna false
		if(!isset($data) || empty($data)) return false;

		//se um id não foi informado, ele insere o registro no bd
		if($id == null)
			$query = $this->db->insert('clientes',$data);
		//se um id for informado, ele tenta atualizar os dados
		else
			$query = $this->db->update("clientes",$data, array("cliente_id"=>$id));
		
		//retorna o resultado da query
		return $query;

	}

	/**
	  * Página para deletar um cliente
	  *
	  * Tenta deletar um cliente a partir de um id
	  *
	  * @author  Gustavo Vilas Boas
	  * @since 29/06/2016
	  * @param (int) id (id do cliente a ser deletado, passado pela url)
	  * @return (bool) false caso o cliente não for deletado com sucesso ou o id não for informado
	  * @return (bool) true caso o dado for deletado com sucesso
  	*/
	public function delete_client($id) {	
		//verifica se um id foi informado
		if(!isset($id) || empty($id)) return false;

		//retorna o status da query
		return $this->db->delete("clientes", array("cliente_id" => $id));

	}

}