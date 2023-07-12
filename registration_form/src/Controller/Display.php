<?php
/**
 * @file
 * Contains \Drupal\registration_form\Controller\Display.
 */

namespace Drupal\registration_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class Display.
 *
 * @package Drupal\registration_form\Controller
 */
class Display extends ControllerBase {

  /**
   * showdata.
   *
   * @return string
   *   Return Table format data.
   */
  public function showdata() {

// you can write your own query to fetch the data I have given my example.

    $result = \Drupal::database()->select('stud', 'n')
            ->fields('n', array('id', 'firstname', 'lastname','age','marks'))
            ->execute()->fetchAllAssoc('id');
   
// Create the row element.
    $rows = array();
    foreach ($result as $row => $content) {
      
      // .Url::fromUserInput('/registration_form/Controller/delete/'.$content->id)
      //$delete = "<a href='/registration_form/Controller/delete/'.$content->id><button>Delete</button></a>";
      $delete = '<a href="/registration_form/Controller/delete" target="_blank" class="btn btn-primary" role="button">delete</a>';
      $rows[] = array(
        'data' => array($content->id, $content->firstname, $content->lastname,$content->age,$content->marks,$content->edit,$delete));
        
    }
// Create the header.
    $header = array('id', 'firstname', 'lastname','age','marks','edit','delete');
    $output = array(
      '#theme' => 'table',    // Here you can write #type also instead of #theme.
      '#header' => $header,
      '#rows' => $rows
      
    );
    return $output;
  }
}
