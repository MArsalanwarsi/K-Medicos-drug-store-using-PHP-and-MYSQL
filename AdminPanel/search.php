<?php
include "../config.php";
if (isset($_POST['index'])) {

    $value = $_POST['index'];
    if ($value == "") {
        $search = mysqli_query($db, "SELECT * FROM orders");
        $sno = 1;
        $exp = "";
        foreach ($search as $data) {
            $exp .= "<tr>
            <td>$sno </td>
             <td>" . $data['u_name'] . "</td>
            <td>" . $data['p_name'] . "</td>
            <td>" . $data['p_price'] . "</td>
            <td>" . $data['p_quantity'] . "</td>
            <td>" . $data['delivery_status'] . " </td>
            <td class='d-flex'>
              <form action='../print.php' method='post' class='mr-2'>
                <input type='hidden' name='order' value='" . $data['id'] . "'>
                <input type='submit' name='print_order' class='btn btn-outline-success ' value='Print Order'>
              </form>
              <form action='../shipping_label.php' method='post'>
                <input type='hidden' name='order' value='" . $data['id'] . "'>
                <input type='submit' name='print_label' class='btn btn-outline-success' value='Print Label'>
              </form>
            </td>
        </tr>";
            $sno++;
        }

        echo $exp;
    } else {
        $search = mysqli_query($db, "SELECT * FROM orders WHERE u_name LIKE '%{$value}%'");
        $sno = 1;
        $exp = "";
        foreach ($search as $data) {
            $exp .= "<tr>
            <td>$sno </td>
             <td>" . $data['u_name'] . "</td>
            <td>" . $data['p_name'] . "</td>
            <td>" . $data['p_price'] . "</td>
            <td>" . $data['p_quantity'] . "</td>
            <td>" . $data['delivery_status'] . " </td>
            <td class='d-flex'>
              <form action='../print.php' method='post' class='mr-2'>
                <input type='hidden' name='order' value='" . $data['id'] . "'>
                <input type='submit' name='print_order' class='btn btn-outline-success ' value='Print Order'>
              </form>
              <form action='../shipping_label.php' method='post'>
                <input type='hidden' name='order' value='" . $data['id'] . "'>
                <input type='submit' name='print_label' class='btn btn-outline-success' value='Print Label'>
              </form>
            </td>
        </tr>";
            $sno++;
        }

        echo $exp;
    }
}

if (isset($_POST['company'])) {
    $value = $_POST['company'];
    $fetchAllCompany = mysqli_query($db, "SELECT * FROM company WHERE company_name LIKE '%{$value}%'");
    $sno = 1;
    $exp = "";
    foreach ($fetchAllCompany as $data) {
        $exp .= "<tr>
                            <td>$sno 
                            </td>
                             <td>" . $data['company_name'] . " </td>
                             <td>
                              <button class='btn btn-outline-success' style='margin-right:10px;' data-toggle='modal'
                                data-target='#update" . $data['id'] . "'>Update</button>
                              <button class='btn btn-outline-danger' data-toggle='modal'
                                data-target='#delete" . $data['id'] . "'>Delete
                              </button>
                            </td>
                          </tr>
                           <!-- Update Company  -->
                          <div class='modal fade' id='update" . $data['id'] . "' tabindex='-1' role='dialog'
                            aria-labelledby='update" . $data['id'] . "' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                              <form action='company.php' method='POST' enctype='multipart/form-data'>
                                <div class='modal-content '>
                                  <div class='modal-header bg-success'>
                                    <h5 class='modal-title' id='update" . $data['id'] . "'>Update Company</h5>
                                    <button type='button' class='close text-danger' data-dismiss='modal'
                                      aria-label='Close'>
                                      <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>
                                  <div class='modal-body'>
                                    <div class='form-group row'>
                                      <div class='col-sm-12'>
                                        <label for='company_name'>Comapny Name</label>
                                        <input type='hidden' name='update_id' value=" . $data['id'] . "'>
                                        <input type='text' class='form-control text-light' name='company_name'
                                          value=" . $data['company_name'] . "' id='company_name'
                                          placeholder='Company Name'>
                                      </div>
                                    </div>


                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                    <button type='submit' name='update_company' class='btn btn-success'>Update</button>
                                  </div>
                                </div>
                              </form>
                            </div>

                          </div>
                          <!-- Update Company  -->

                          <!-- Delete Company -->
                          <div class='modal fade' id='delete" . $data['id'] . "' tabindex='-1' role='dialog'
                            aria-labelledby='delete" . $data['id'] . "' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                              <form action='company.php' method='POST' enctype='multipart/form-data'>
                                <div class='modal-content '>
                                  <div class='modal-header bg-danger'>
                                    <h5 class='modal-title' id='delete" . $data['id'] . "'>Delete Company</h5>
                                    <button type='button' class='close text-light' data-dismiss='modal'
                                      aria-label='Close'>
                                      <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>
                                  <div class='modal-body'>
                                    <input type='hidden' name='delete_id' value=" . $data['id'] . "'>
                                    <p>Are you sure you want to delete this Company ?</p>
                                  </div>
                                  <div class='modal-footer'>
                                    <button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
                                    <button type='submit' name='delete_company' class='btn btn-danger'>Delete</button>
                                  </div>
                                </div>
                              </form>
                            </div>

                          </div>
                           <!-- Delete Company -->";
        $sno++;
    }

    echo $exp;
}
