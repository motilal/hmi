<?php

/*
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Packages extends CI_Controller {

    var $viewData = array();
    var $per_page = DEFAULT_PAGING;

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array("package_model" => 'package'));
    }

    public function index() {
        $this->acl->has_permission('package-index');
        $condition = array();
        if ($this->input->is_ajax_request() || $this->input->get('download') == 'report') {
            $orderColomn = array(2 => 'p.name', 3 => 'category_name', 4 => 'days', 5 => 'p.created', 6 => 'p.is_active');
            $params = dataTableGetRequest($this->input->get(), $orderColomn);
            if (!empty($params->search)) {
                $keyword = $this->db->escape_str($params->search);
                $condition["(p.name like '%{$keyword}%' OR pc.name like '%{$keyword}%' OR description like '%{$keyword}%')"] = null;
            }
            $result = $this->package->get_list($condition, $params->limit, $params->order, TRUE);
            if ($this->input->get('download') == 'report') {
                $this->acl->has_permission('package-export');
                $this->generateCsv($result->data->result());
            }
            if ($result->data->num_rows() > 0) {
                $response['data'] = $this->showTableData($result->data->result());
            } else {
                $response['data'] = array();
            }
            $response['recordsFiltered'] = $response['recordsTotal'] = $result->num_rows;
            $this->output->set_content_type('application/json')->set_output(json_encode($response))->_display();
            exit();
        }
        $this->viewData['title'] = "Manage Package";
        $this->viewData['pageModule'] = 'Package Manager';
        $this->viewData['pageHeading'] = 'Package';
        $this->viewData['breadcrumb'] = array('Package Manager' => '');
        $this->viewData['datatable_asset'] = true;
        $this->layout->view("admin/package/index", $this->viewData);
    }

    public function manage($id = null) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        $this->viewData['title'] = "Add Package";
        if ($id > 0) {
            $this->acl->has_permission('package-edit');
            $this->viewData['data'] = $detail = $this->package->getById($id);
            if (empty($detail)) {
                $this->session->set_flashdata("error", __('LinkExpired'));
                redirect('admin/packages');
            }
            $this->viewData['title'] = "Edit Package";
        } else {
            $this->acl->has_permission('package-add');
        }

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "name" => $this->input->post('name'),
                "category" => $this->input->post('category'),
                "city" => $this->input->post('city'),
                "days" => $this->input->post('days'),
                "age_limit" => $this->input->post('age_limit'),
                "description" => $this->input->post('description', false),
                "detail_itinerary" => $this->input->post('detail_itinerary', false),
                "places_covered" => $this->input->post('places_covered', false),
                "tourist_places" => $this->input->post('tourist_places', false),
                "inclusions" => $this->input->post('inclusions', false),
                "exclusions" => $this->input->post('exclusions', false),
                "terms_conditions" => $this->input->post('terms_conditions', false),
                "cancellation_refund_policy" => $this->input->post('cancellation_refund_policy', false)
            );
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                $fileUpload = $this->do_upload();
                if (isset($fileUpload['error']) && $fileUpload['error'] != "") {
                    $this->session->set_flashdata("error", $fileUpload['error']);
                    redirect("admin/packages/manage/$id");
                } else {
                    @unlink(PACKAGE_IMG_PATH . $detail->image);
                    $data['image'] = $fileUpload['upload_data']['file_name'];
                }
            }
            if ($id > 0) {
                $data['slug'] = create_unique_slug($this->input->post('title'), 'packages', 'slug', 'id', $id);
            } else {
                $data['slug'] = create_unique_slug($this->input->post('title'), 'packages', 'slug');
            }
            if ($this->input->post('id') > 0) {
                $data['updated'] = date("Y-m-d H:i:s");
                $this->db->update("packages", $data, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", __('PackageUpdateSuccess'));
            } else {
                $data['created'] = date("Y-m-d H:i:s");
                $this->db->insert("packages", $data);
                $this->session->set_flashdata("success", __('PackageAddSuccess'));
            }
            redirect("admin/packages");
        }

        $this->viewData['ckeditor_asset'] = true;
        $this->viewData['pageModule'] = 'Add Package';
        $this->viewData['breadcrumb'] = array('Package Manager' => 'admin/packages', $this->viewData['title'] => '');
        $this->viewData['categories_options'] = $this->package->categories_options();
        $this->load->model('city_model', 'city');
        $this->viewData['cities_options'] = $this->city->cities_options(TRUE);
        $this->layout->view("admin/package/manage", $this->viewData);
    }

    private function do_upload() {
        if (!is_dir(PACKAGE_IMG_PATH)) {
            mkdir(PACKAGE_IMG_PATH, DIR_WRITE_MODE, TRUE);
        }
        $config['upload_path'] = PACKAGE_IMG_PATH;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors('', ''));
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('package-delete', FALSE);
            if ($has_permission === TRUE) {
                $detail = $this->package->getById($id);
                if ($detail->image != "") {
                    @unlink(DISCUSSION_IMG_PATH . $detail->image);
                }
                if ($id > 0 && $this->db->where("id", $id)->delete("packages")) {
                    $response['success'] = __('PackageDeleteSuccess');
                } else {
                    $response['error'] = __('InvalidRequest');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function changestatus() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $has_permission = $this->acl->has_permission('package-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                if ($status == "1") {
                    $this->db->where("id", $id)->update("packages", array("is_active" => 0));
                    $response['success'] = __('PackageInactiveSuccess');
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("packages", array("is_active" => 1));
                    $response['success'] = __('PackageActiveSuccess');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    private function showTableData($data) {
        $resultData = array();
        if ($data != "") {
            foreach ($data as $key => $row) {
                $img_path = "asset/admin/images/no_image_100.jpg";
                if (!empty($row->image)) {
                    $getImg = getPackageImage($row->image, array('width' => 100, 'height' => 100));
                    if ($getImg) {
                        $img_path = $getImg;
                    }
                }
                $rowData = array();
                $rowData[0] = getPageSerial($this->input->get('length'), $this->input->get('start'), $key);
                $rowData[1] = img($img_path, FALSE, array('width' => 75));
                $rowData[2] = $row->name;
                $rowData[3] = $row->category_name;
                $rowData[4] = $row->days;
                $rowData[5] = date(DATE_FORMATE, strtotime($row->created));
                $rowData[6] = $this->layout->element('admin/element/_module_status', array('status' => $row->is_active, 'id' => $row->id, 'url' => "admin/packages/changestatus", 'permissionKey' => "package-status"), true);
                $editUrl = 'admin/packages/manage/' . $row->id;
                $deleteUrl = 'admin/packages/delete';
                $galleryUrl = 'admin/packages/gallery/' . $row->id;
                $rowData[7] = $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'editUrl' => $editUrl, 'deleteUrl' => $deleteUrl, 'galleryUrl' => $galleryUrl, 'editPermissionKey' => 'package-edit', 'deletePermissionKey' => 'package-delete'), true);
                $resultData[] = $rowData;
            }
        }
        return $resultData;
    }

    public function categories() {
        $this->acl->has_permission('package-category-index');
        $condition = array();
        $start = (int) $this->input->get('start');
        $result = $this->package->get_category_list($condition);
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Category Listing";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['pageModule'] = 'Package Categories';
        $this->viewData['pageHeading'] = 'Category Listing';
        $this->viewData['breadcrumb'] = array('Package Manager' => 'admin/packages', $this->viewData['title'] => '');
        $this->layout->view("admin/package/categories", $this->viewData);
    }

    public function category_manage() {
        $this->load->library('form_validation');
        $response = array();
        if ($this->form_validation->run('manage_category') === TRUE) {
            $data = array(
                "name" => $this->input->post('name')
            );
            if ($this->input->post('id') > 0) {
                $data['slug'] = create_unique_slug($this->input->post('name'), 'packages_categories', 'slug', 'id', $this->input->post('id'));
            } else {
                $data['slug'] = create_unique_slug($this->input->post('name'), 'packages_categories', 'slug');
            }
            if ($this->input->post('id') > 0) {
                $has_permission = $this->acl->has_permission('package-category-edit', FALSE);
                if ($has_permission === TRUE) {
                    $this->db->update("packages_categories", $data, array("id" => $this->input->post('id')));
                    $resource_id = $this->input->post('id');
                    $response['msg'] = 'Category successfully updated';
                    $response['mode'] = 'edit';
                }
            } else {
                $has_permission = $this->acl->has_permission('package-category-add', FALSE);
                if ($has_permission === TRUE) {
                    $data['is_active'] = 1;
                    $this->db->insert("packages_categories", $data);
                    $resource_id = $this->db->insert_id();
                    $response['msg'] = 'Category successfully added';
                    $response['mode'] = 'add';
                }
            }
            if ($has_permission === TRUE) {
                $detail = $this->package->getCategoryById($resource_id);
                $detail->statusButtons = $this->layout->element('admin/element/_module_status', array('status' => $detail->is_active, 'id' => $detail->id, 'url' => "admin/packages/category_changestatus", 'permissionKey' => "package-category-status"), true);
                $detail->actionButtons = $this->layout->element('admin/element/_module_action', array('id' => $detail->id, 'editUrl' => 'admin/packages/category_manage', 'deleteUrl' => 'admin/packages/category_delete', 'editPermissionKey' => 'package-category-edit', 'deletePermissionKey' => 'package-category-delete'), true);
                $response['data'] = $detail;
                $response['success'] = true;
            } else {
                $response['error'] = $has_permission;
            }
        } else {
            $response['validation_error'] = $this->form_validation->error_array();
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function category_delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('package-category-delete', FALSE);
            if ($has_permission === TRUE) {
                if ($id > 0 && $this->db->where("id", $id)->delete("packages_categories")) {
                    $response['success'] = 'Package category deleted successfully.';
                } else {
                    $response['error'] = 'Invalid request';
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function category_changestatus() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $has_permission = $this->acl->has_permission('package-category-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                $packagesaction = '';
                if ($status == "1") {
                    $this->db->where("id", $id)->update("packages_categories", array("is_active" => 0));
                    $packagesaction = 'Inactive';
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("packages_categories", array("is_active" => 1));
                    $packagesaction = 'Active';
                }
                $response['success'] = "Package category $packagesaction Successfully.";
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    private function generateCsv($result) {
        $this->load->helper('csv');
        $csv_array[] = ["name" => 'Name',
            "category" => 'Category',
            "city" => 'City',
            "days" => 'No. of days',
            "age_limit" => 'Age Limit',
            "description" => 'Description',
            "detail_itinerary" => 'Detail Itinerary',
            "places_covered" => 'Places Covered',
            "tourist_places" => 'Tourist Places',
            "inclusions" => 'Inclusions',
            "exclusions" => 'Exclusions',
            "terms_conditions" => 'Terms Conditions',
            "cancellation_refund_policy" => 'Cancellation Refund Policy',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified'
        ];
        if (!empty($result)) {
            foreach ($result as $row) {
                $csv_array[] = ["name" => $row->name,
                    "category" => $row->category_name,
                    "city" => $row->city_name,
                    "days" => $row->days,
                    "age_limit" => $row->age_limit,
                    "description" => $row->description,
                    "detail_itinerary" => $row->detail_itinerary,
                    "places_covered" => $row->places_covered,
                    "tourist_places" => $row->tourist_places,
                    "inclusions" => $row->inclusions,
                    "exclusions" => $row->exclusions,
                    "terms_conditions" => $row->terms_conditions,
                    "cancellation_refund_policy" => $row->cancellation_refund_policy,
                    'status' => $row->is_active == 1 ? 'Active' : 'InActive',
                    'created' => date(DATETIME_FORMATE, strtotime($row->created)),
                    'modified' => date(DATETIME_FORMATE, strtotime($row->updated))
                ];
            }
        }
        $Today = date('dmY');
        array_to_csv($csv_array, "Package_$Today.csv");
        exit();
    }

    public function gallery($id) {
        $this->acl->has_permission('package-gallery');
        $this->viewData['data'] = $detail = $this->package->getById($id);
        if (empty($detail)) {
            $this->session->set_flashdata("error", __('LinkExpired'));
            redirect('admin/packages');
        }
        $this->viewData['title'] = "Manage Package Gallary";
        $this->viewData['pageModule'] = 'Package Manager';
        $this->viewData['pageHeading'] = $detail->name . ' Gallery';
        $this->viewData['breadcrumb'] = array('Package Manager' => 'admin/packages', 'Gallery' => '');
        $this->layout->view("admin/package/gallery", $this->viewData);
    }

    public function upload_gallery($id) {
        $this->viewData['data'] = $detail = $this->package->getById($id);
        if (empty($detail)) {
            $this->session->set_flashdata("error", __('LinkExpired'));
            redirect('admin/packages');
        }
        $this->load->model(array("gallery_model" => "gallery"));
        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');
        $filename = $this->input->get('file');
        $this->gallery->package_id = $id;
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                break;
            case 'HEAD':
            case 'GET':
                $this->gallery->get();
                break;
            case 'POST':
                if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
                    $this->gallery->delete();
                } else {
                    $this->gallery->post();
                }
                break;
            case 'DELETE':
                $this->gallery->delete($filename);
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
        }
    }

}
