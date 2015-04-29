<?php 
	namespace Gaia\Repositories;

	interface PageRepositoryInterface
	{
		public function getAll();
		public function find($id);
		public function create($input);
	}
?>