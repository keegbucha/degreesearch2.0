<?php
include("dBug.php");
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $query->have_posts() )
{
	?>
	
	<div class="pagination">
		
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>

	
	<?php
  global $searchandfilter;
	$sf_current_query = $searchandfilter->get(1102)->current_query();
  /*
  echo '<pre>';
  print_r($sf_current_query->get_array());  
  echo '</pre>';
  */
  

	
  $array_data = $sf_current_query->get_array();
  $location_array = array();
  $degreetype_array = array();
  
	if(isset($array_data["_sfm_degreetype"])){
		for ($i = 0; $i < count($array_data["_sfm_degreetype"]["active_terms"]); $i++){
			$degreetype_Query = array_push($degreetype_array, $array_data["_sfm_degreetype"]["active_terms"][$i]["name"]);
			echo "<span id='degreetypetfilter'>Type: {$degreetype_array[$i]} <i class='fa-solid fa-xmark'></i></span>";
			echo " ";
		}
	}
	
  if(isset($array_data["_sfm_location"])){
		for ($i = 0; $i < count($array_data["_sfm_location"]["active_terms"]); $i++){
			$location_Query = array_push($location_array, $array_data["_sfm_location"]["active_terms"][$i]["name"]);
			echo "<span id='locationfilter'>Location: {$location_array[$i]}</span>";
			echo " ";
		}		
	}

  
	if(isset($array_data["_sfm_department"])){
		$department_Query = $array_data["_sfm_department"]["active_terms"][0]["name"];	 
		echo "<span id='departmentfilter'>Department: {$department_Query}</span>";
		echo " ";	 
	}
		
	if(isset($array_data["_sfm_college"])){
		$college_Query = $array_data["_sfm_college"]["active_terms"][0]["name"];	
		echo "<span id='collegefilter'>College: {$college_Query}</span>";
		echo " ";
	}
  
    $searched_Query = $sf_current_query->get_search_term(); //grabs searched term
    if($searched_Query != ""){
        echo "<span id='querysearch'>Search: {$searched_Query}</span>";
    }


  
  echo "<div id='querygap'></div>";
  
      function php_func(){
          echo " Have a great day";
      }
	while ($query->have_posts())
	{
		$query->the_post();
		?>
		<div class="degreelisting">
      <div class="degreetitle">
         <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <p id="department">
          <?php 
             /* 20220616 keegan: added functions to fetch post meta data to call in degree listings */
             $department = get_post_meta(get_the_ID(), 'department', true);
             if ($department == "fa"){
                $department = "Fine Arts";
             }
             else if ($department == "management"){
                  $department = "Management";
              }
             else if ($department == "cj"){
                  $department = "Criminal Justice";
              }
             else if ($department == "ci"){
                  $department = "Curriculum and Instruction";
            }
             else if ($department == "mlsphns"){
                  $department = "Medical Laboratory Sciences, Public Health & Nutrition Science";
            }
             else if ($department == "engtech"){
                  $department = "Engineering Technology";
            }
             else if ($department == "cs" || $department == "communication"){
                  $department = "Communication Studies";
            }
             else if ($department == "glsp" || $department == "government"){
                  $department = "Government, Legal Studies and Philosophy";
            }
             else if ($department == "aec"){
                  $department = "Agricultural Education and Communication";
            }
             else if ($department == "mcis"){
                  $department = "Marketing and Computer Information Systems";
            }
             else if ($department == "csee"){
                  $department = "Computer Science and Electrical Engineering";
            }
             else if ($department == "afe"){
                  $department = "Accounting, Finance and Economics";
            }
             else if ($department == "cgp"){
                  $department = "Chemistry, Geoscience and Physics";
            }
             else if ($department == "hsg"){
                  $department = "History, Sociology and Geography";
            }
             else if ($department == "bs"){
                  $department = "Biological Sciences";
            }
             else if ($department == "pa"){
                  $department = "Public Administration";
            }
             else if ($department == "sk"){
                  $department = "School of Kinesiology";
            }
            else if ($department == "kines"){
                  $department = "Kinesiology";
           }
             else if ($department == "nursing"){
                  $department = "Nursing";
            }
             else if ($department == "ss"){
                  $department = "Sport Science";
            }
             else if ($department == "eal" || $department == "english"){
                  $department = "English and Languages";
            }
             else if ($department == "mathematics"){
                  $department = "Mathematics";
            }
             else if ($department == "ps"){
                  $department = "Physiological Sciences";
            }
             else if ($department == "as"){
                  $department = "Animal Science";
            }
             else if ($department == "mece"){
                  $department = "Mechanical, Environmental and Civil Engineering";
            }
            else if ($department == "edlt"){
                  $department = "Educational Leadership and Technology";
            }
            else if ($department == "sw"){
                  $department = "Social Work";
            }
            else if ($department == "wnr"){
                  $department = "Wildlife and Natural Resources";
            }
            else if ($department == "counseling"){
                  $department = "Counseling";
            }
            else if ($department == "hhp"){
                  $department = "Health and Human Performance";
            }
            
            echo $department;
           ?>
      </div>
			<!--- 20220615 jt: removed '<br> after <p> open below --->
			<div class="degreeinfo">
              <p><?php the_excerpt(); ?></p>
              <table class="degreeattributes">
                <tr>
                  <td>
                    <p><strong>College:</strong><br><?php 
                   /* 20220616 keegan: added functions to fetch post meta data to call in degree listings */
                   $college = get_post_meta(get_the_ID(), 'college', true);
                   if ($college == "business"){
                      $college = "Business";
                   }
                  else if ($college == "colfa"){
                      $college = "Liberal and Fine Arts";
                  }
                  else if ($college == "cosm"){
                      $college = "Science and Mathematics";
                  }
                  else if ($college == "mcoe"){
                      $college = "Mayfield College of Engineering";
                  }
                  else if ($college == "chshs"){
                      $college = "Health Sciences and Human Services";
                  }
                  else if ($college == "sok"){
                      $college = "School of Kinesiology";
                  }
                  else if ($college == "cogs"){
                      $college = "Graduate Studies";
                  }
                  else if ($college == "coanr" || $college == "coaes"){
                      $college = "Agriculture and Natural Resources";
                  }
                  else if ($college == "coe"){
                      $college = "Education and Human Development";
                  }
                  else if ($college == "sccpaj"){
                      $college = "School of Criminology, Criminal Justice and Public Administration";
                  }
                  echo $college;
                  ?></p>
                  </td>
                  <td>
                    <p><strong>Department:</strong><br>
                    <?php
                        $department = get_post_meta(get_the_ID(), 'department', true);
                         if ($department == "fa"){
                            $department = "Fine Arts";
                         }
                         else if ($department == "management"){
                              $department = "Management";
                          }
                         else if ($department == "cj"){
                              $department = "Criminal Justice";
                          }
                         else if ($department == "ci"){
                              $department = "Curriculum and Instruction";
                        }
                         else if ($department == "mlsphns"){
                              $department = "Medical Laboratory Sciences, Public Health & Nutrition Science";
                        }
                         else if ($department == "engtech"){
                              $department = "Engineering Technology";
                        }
                         else if ($department == "cs" || $department == "communication"){
                              $department = "Communication Studies";
                        }
                         else if ($department == "glsp" || $department == "government"){
                              $department = "Government, Legal Studies and Philosophy";
                        }
                         else if ($department == "aec"){
                              $department = "Agricultural Education and Communication";
                        }
                         else if ($department == "mcis"){
                              $department = "Marketing and Computer Information Systems";
                        }
                         else if ($department == "csee"){
                              $department = "Computer Science and Electrical Engineering";
                        }
                         else if ($department == "kines"){
                              $department = "Kinesiology";
                        }
                         else if ($department == "afe"){
                              $department = "Accounting, Finance and Economics";
                        }
                         else if ($department == "cgp"){
                              $department = "Chemistry, Geoscience and Physics";
                        }
                         else if ($department == "hsg"){
                              $department = "History, Sociology and Geography";
                        }
                         else if ($department == "bs"){
                              $department = "Biological Sciences";
                        }
                         else if ($department == "pa"){
                              $department = "Public Administration";
                        }
                         else if ($department == "sk"){
                              $department = "School of Kinesiology";
                        }
                         else if ($department == "nursing"){
                              $department = "Nursing";
                        }
                         else if ($department == "ss"){
                              $department = "Sport Science";
                        }
                         else if ($department == "eal" || $department == "english"){
                              $department = "English and Languages";
                        }
                         else if ($department == "mathematics"){
                              $department = "Mathematics";
                        }
                         else if ($department == "ps"){
                              $department = "Physiological Sciences";
                        }
                         else if ($department == "as"){
                              $department = "Animal Science";
                        }
                         else if ($department == "mece"){
                              $department = "Mechanical, Environmental and Civil Engineering";
                        }
                        else if ($department == "edlt"){
                              $department = "Educational Leadership and Technology";
                        }
                        else if ($department == "sw"){
                              $department = "Social Work";
                        }
                        else if ($department == "wnr"){
                              $department = "Wildlife and Natural Resources";
                        }
                        else if ($department == "counseling"){
                              $department = "Counseling";
                        }
                        else if ($department == "hhp"){
                              $department = "Health and Human Performance";
                        }
                        else{
                              $department = "-";  
                        } 
                        echo $department;
                      ?>
                    </p>
                  </td>
                  <td><strong><p>Certifications:<br></strong>
                    <?php
                        $certifications = get_post_meta(get_the_ID(), 'certifications', true);
                        if ($certifications == "professional"){
                          $certifications = "Professional Certification";
                        }
                        else if ($certifications == "teacher"){
                          $certifications = "Teacher Certification";
                        }
                        else if ($certifications == "cybersecurity"){
                          $certifications = "Cybersecurity Certification";
                        }
                        else if ($certifications == "advancedtechnical"){
                          $certifications = "Advanced Technical Certificate";
                        }
                        else{
                          $certifications = "-";
                        }
                        echo $certifications;
                    ?>
                    </p>
                  </td>
                  <td>
                    <p><strong>Location:</strong><br>
                      <?php
                        $location = get_post_meta(get_the_ID(), 'location', false);
                        $last = end($location);
                        foreach ($location as $location){ 
                          if ($location == "stephenville"){
                            $location = "Stephenville";
                          }
                          else if ($location == "fortworth"){
                            $location = "Fort-Worth";
                          }
                          else if ($location == "waco"){
                            $location = "Waco";
                          }
                          else if ($location == "rellisbryan"){
                            $location = "RELLIS-Bryan";
                          }
                          else if ($location == "online"){
                            $location = "Online";
                          }
                          else if ($location == "midlothian"){
                            $location = "Midlothian";
                          }
                          /*changes the last variable to check the last element of the array */
                           if ($last == "stephenville"){
                            $last = "Stephenville";
                          }
                          else if ($last == "fortworth"){
                            $last = "Fort-Worth";
                          }
                          else if ($last == "waco"){
                            $last = "Waco";
                          }
                          else if ($last == "rellisbryan"){
                            $last = "RELLIS-Bryan";
                          }
                          else if ($last == "online"){
                            $last = "Online";
                          }
                          else if ($last == "midlothian"){
                            $last = "Midlothian";
                          }
                          if ($last == $location){
                            echo $location;
                          }
                          else{
                            echo $location . ", ";
                           }
                        }               
                      ?>
                      
                    </p>
                  </td>
                </tr>
        </table>
                </div>
              </div>
              <br />
		<hr />
		<?php
	}
	?>
	
		<?php
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
	<?php
}
else
{
	//figure out which type of "no results" message to show
 $message = "noresults"; 
 if(isset($query->query['paged'])) {  
  if($query->query['paged']>1){
   $message = "endofresults";
  }
 }
 
    if($message=="noresults") {
      
    ?>
 <div class='search-filter-results-list' data-search-filter-action='infinite-scroll-end'>
   <?php
        global $searchandfilter;
	$sf_current_query = $searchandfilter->get(1102)->current_query();
  //echo $sf_current_query->get_search_term(); grabs searched term
  /*
  echo '<pre>';
  print_r($sf_current_query->get_array());  
  echo '</pre>';
  */
  

	
  $array_data = $sf_current_query->get_array();
  $location_array = array();
  $degreetype_array = array();
      if(isset($array_data["_sfm_degreetype"])){
		for ($i = 0; $i < count($array_data["_sfm_degreetype"]["active_terms"]); $i++){
			$degreetype_Query = array_push($degreetype_array, $array_data["_sfm_degreetype"]["active_terms"][$i]["name"]);
			echo "<span id='degreetypetfilter'>Type: {$degreetype_array[$i]}</span>";
			echo " ";
		}
	}

    $searched_Query = $sf_current_query->get_search_term(); //grabs searched term
    if($searched_Query != ""){
        echo "<span id='querysearch'>Search: {$searched_Query}</span>";
    }
	
  if(isset($array_data["_sfm_location"])){
		for ($i = 0; $i < count($array_data["_sfm_location"]["active_terms"]); $i++){
			$location_Query = array_push($location_array, $array_data["_sfm_location"]["active_terms"][$i]["name"]);
			echo "<span id='locationfilter'>Location: {$location_array[$i]}</span>";
			echo " ";
		}		
	}

  
	if(isset($array_data["_sfm_department"])){
		$department_Query = $array_data["_sfm_department"]["active_terms"][0]["name"];	 
		echo "<span id='departmentfilter'>Department: {$department_Query}</span>";
		echo " ";	 
	}
		
	if(isset($array_data["_sfm_college"])){
		$college_Query = $array_data["_sfm_college"]["active_terms"][0]["name"];	
		echo "<span id='collegefilter'>College: {$college_Query}</span>";
		echo " ";
	}
      ?>
  <span><br><br>No Results Found</span>
 </div>
 <?php
    } else {
 ?>
 <div class='search-filter-results-list' data-search-filter-action='infinite-scroll-end'>
  <span>End of Results</span>
 </div>
 <?php
 }
}
?>