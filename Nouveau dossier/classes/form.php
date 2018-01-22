<?php
	class Form{
		private $form;

		/**
		 * 	Constructeur de la classe form qui permet de commencer le formulaire HTML
		 *	@param string $_name le nom du formulaire créé
		 *	@param string $_action l'action du formulaire créé
		 *	@param string $_method la méthode utilisée dans ce formulaire
		 *	@param string $_enctype l'enctype utlisé dans ce formulaire
		*/
		public function __construct($_name,$_action,$_method,$_enctype){
			$this->form = "<form name='".$_name."' action='".$_action."' method='".$_method."'";

			//On regarde si on a un 'enctype'
			if($_enctype == ""){
				$this->form .=">";
			}
			else{
				$this->form .= " enctype='".$_enctype."'>";
			}
		}

		/**
		 * 	Permet d'ajouter un input dans le formulaire créé
		 *	@param string $_type le type de l'input ajouté
		 *	@param string $_name le nom de l'input ajouté
		 *	@param string $_placeholder le placeholder de l'input ajouté (peut être vide)
		 *	@param boolean $_required si oui ou non l'input est obligatoire à remplir
		*/
		public function set_input($_type,$_name,$_placeholder,$_required){
			$this->form .= '<div class="group"><input type="' .$_type. '"';

			if($_name != ""){
				$this->form .= " name='".$_name."'";
			}

			/*if($_placeholder != ""){
				$this->form .= " placeholder='".$_placeholder."'";
			}*/

			if($_required){
				$this->form .= " required";
			}

			$this->form .= ">";
			$this->form .= '<span class="highlight"></span><span class="bar"></span>';
			$this->form .= '<label>' . $_placeholder . '</label></div>';
		}

		/**
		 * 	Permet d'ajouter le bouton de validation du formulaire
		 *	@param string $_name le nom du bouton de validation
		 *	@param string $_value la valeur que prend le bouton de validation
		*/
		public function set_submit($_name,$_value){
			$this->form .= '<input type="submit" name="'.$_name.'" value="'.$_value.'">';
		}

		/**
		 * 	Permet d'obtenir le formulaire complet créé
		 *	@return string $this->form le formulaire complet créé 
		*/
		public function get_form(){
			$this->form .= "</form>";
			return $this->form;
		}

		/**
		 * 	Permet d'ajouter un input caché au formulaire
		 *	@param string $_name le nom de l'input caché
		 *	@param string $_value la valeur que prend l'input caché
		*/
		public function set_hidden($_name,$_value){
			$this->form .= "<input type='hidden' name='".$_name."' value='".$_value."'>";
		}
		/**
		 * 	Permet d'ajouter un input avec une valeur dans le formulaire créé
		 *	@param string $_type le type de l'input ajouté
		 *	@param string $_name le nom de l'input ajouté
		 *	@param string $_placeholder le placeholder de l'input ajouté (peut être vide)
		 *	@param boolean $_required si oui ou non l'input est obligatoire à remplir
		 *	@param string $_value la valeur que l'input prend
		*/
		public function set_input_value($_type,$_name,$_placeholder,$_required,$_value){
			$this->form .= "<input type='".$_type."'";

			if($_name != ""){
				$this->form .= " name='".$_name."'";
			}

			if($_placeholder != ""){
				$this->form .= " placeholder='".$_placeholder."'";
			}

			if($_required){
				$this->form .= " required";
			}
			if($_value!=""){
				$this->form .= " value='".$_value."'";
			}

			$this->form .= "/>";

		}

		public function add_br(){
			$this->form .= "<br>";
		}

		public function add_radio($_nb_bt,$_name,array $_tab){
			for ($i=0; $i < $_nb_bt; $i++) { 
				$this->form .= '<div class="group"><label><input type="radio" name="' . $_name . '" value="' . $_tab[$i] . '">' . $_tab[$i] . '</label></div>';
			}
		}

		public function set_input_file($_type,$_name,$_placeholder,$_required){
			$this->form .= '<div class="group"><label>Photo</label><br><input type="' .$_type. '"';

			if($_name != ""){
				$this->form .= " name='".$_name."'";
			}

			/*if($_placeholder != ""){
				$this->form .= " placeholder='".$_placeholder."'";
			}*/

			if($_required){
				$this->form .= " required";
			}

			$this->form .= "></div>";
		}

		public function set_input_date($_type,$_name,$_placeholder,$_required){
			$this->form .= '<div class="date"><input type="' .$_type. '"';

			if($_name != ""){
				$this->form .= " name='".$_name."'";
			}

			/*if($_placeholder != ""){
				$this->form .= " placeholder='".$_placeholder."'";
			}*/

			if($_required){
				$this->form .= " required";
			}

			$this->form .= ">";
			$this->form .= '<span class="highlight"></span><span class="bar"></span>';
			$this->form .= '<label>' . $_placeholder . '</label></div>';
		}

		public function set_input_sexe(){
			$this->form .= '<div class="sexe"><label>Sexe</label>
								<input type="radio" name="sexe" value="H" required>H<input type="radio" name="sexe" value="F" required>F
							</div>';
		}

		public function set_input_newsletter(){
			$this->form .= '<div class="newsletter"><label>Newsletter</label>
								<input type="checkbox" name="newsletter" value="H">
							</div>';
		}
	}
?>