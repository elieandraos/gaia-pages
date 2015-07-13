<?php 
	namespace Gaia\Repositories;

	interface TemplateRepositoryInterface
	{
		public function getAll();
		public function getAllTypes();
		public function create($input);
		public function find($templateId);
		public function addEmptySection($templateId);
		public function getSectionsByOrder($templateId);
		public function findSection($sectionId);
		public function findComponent($componentId);
		public function addComponent($input);
	}
?>