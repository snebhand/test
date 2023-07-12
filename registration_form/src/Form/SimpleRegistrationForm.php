<?php
 
namespace Drupal\registration_form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Routing;


class SimpleRegistrationForm extends FormBase {
 public function getFormId() {
   // Here we set a unique form id
   return 'simple_form';
 }
 
 public function buildForm(array $form, FormStateInterface $form_state, $username = NULL) {
    // Textfield form element.
   $form['firstname'] = array(
     '#type' => 'textfield',
     '#title' => t('First Name:'),
     '#required' => TRUE,
   );
    // Textfield form element.
   $form['lastname'] = array(
     '#type' => 'textfield',
     '#title' => t('Last Name:'),
     '#required' => TRUE,
   );
    // Textfield form element.
   $form['age'] = array(
     '#type' => 'textfield',
     '#title' => t('age:'),
     '#required' => TRUE,
   );
   
    // Textfield form element.
   $form['marks'] = array (
     '#type' => 'textfield',
     '#title' => t('marks'),
     '#required' => TRUE,
   );
   /*
   // select form element.
   $form['gender'] = array (
     '#type' => 'select',
     '#title' => ('Gender'),
     '#options' => array(
       'Female' => t('Female'),
       'male' => t('Male'),
     ),
   );
   // Radio buttons form elements.
   $form['confirmation'] = array (
     '#type' => 'radios',
     '#title' => ('Are you above 18 years old?'),
     '#options' => array(
       'Yes' =>t('Yes'),
       'No' =>t('No')
     ),
   );
   */
   //submit button.
   $form['actions']['submit'] = array(
     '#type' => 'submit',
     '#value' => $this->t('Save'),
     '#button_type' => 'primary',
   );
   return $form;
 }
    /**
   * {@inheritdoc}
   */
  public function validateForm(array & $form, FormStateInterface $form_state) {
    $field = $form_state->getValues();
    
     $fields["firstname"] = $field['firstname'];
     if (!$form_state->getValue('firstname') || empty($form_state->getValue('firstname'))) {
         $form_state->setErrorByName('firstname', $this->t('Provide First Name'));
     }
     
     
}

/**
* {@inheritdoc}
*/
public function submitForm(array & $form, FormStateInterface $form_state) {
 try{
     $conn = Database::getConnection();
     
     $field = $form_state->getValues();
    
     $fields["firstname"] = $field['firstname'];
     $fields["lastname"] = $field['lastname'];
     $fields["age"] = $field['age'];
     $fields["marks"] = $field['marks'];
     
       $conn->insert('stud')
            ->fields($fields)->execute();
       \Drupal::messenger()->addMessage($this->t('The Student data has been succesfully saved'));
      
 } catch(Exception $ex){
     \Drupal::logger('registration_form')->error($ex->getMessage());
 }
 
}

}
