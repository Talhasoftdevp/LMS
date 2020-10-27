<?php
class assignments_logs extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Home_model');
        $this->load->model('Assignments_model');
        // $this->load->model(__CLASS__ . '_model');
        // $this->table_name = humanize(lcfirst(__CLASS__));
        // $this->row_id = singular(lcfirst(__CLASS__ . '_id'));
        // $this->data['title'] = __CLASS__;
    }
    public function index()
    {
        $this->data['records'] =  $this->Assignments_model->all_records();
        $this->load_views($this->data);
    }
    function submitted_assignments($chapterName, $Class, $subject, $chapterID)
    {
        $this->data['class'] = $Class;
        $this->data['subject'] = urldecode($subject);
        $this->data['chapter_id'] = $chapterID;
        $this->data['chapter_name'] = urldecode($chapterName);
        $this->data['students_data'] = $this->Assignments_model->fetch_students($chapterID);
        $this->load_views($this->data, 'assignments/submitted_assignments_view');
    }

    function download_all_assignments($class, $ChapterName, $chapter_id)
    {
        // "../upload/submittedAssignments/";
        // $data = json_decode($_POST['data']);
        // print_die($data);
        // print_die("TEST");
        $searchVal = '%20';
        $replaceVal = '_';
        $ChapterName =  str_replace($searchVal, $replaceVal, $ChapterName);
        $students_data = array();
        $zipname =  $ChapterName . '.zip';
        $rootPath =  "../assignments/" . $ChapterName;
        $students_data = $this->Assignments_model->get_students_name_submitted_assignment($class, $chapter_id);
        // print_die($students_data);
        if (!is_dir("../assignments/" . $ChapterName)) {
            mkdir("../assignments/" . $ChapterName);
            foreach ($students_data as $studentInfo) {
                if (!is_dir("../assignments/" . $ChapterName . "/" . $studentInfo['student_name'])) {
                    mkdir("../assignments/" . $ChapterName . "/" . $studentInfo['student_name']);
                    $file_data = $this->Assignments_model->getFilePath($chapter_id, $studentInfo['student_id'], $class);
                    for ($i = 0; $i < count($file_data); $i++) {
                        $fileSource = "../upload/submittedAssignments/" . $file_data[$i]['path'];
                        $destination = "../assignments/" . $ChapterName . "/" . $studentInfo['student_name'] . "/" . $file_data[$i]['path'];

                        $copy = copy($fileSource, $destination);
                        if ($copy) {
                            // Initialize archive object
                            $zip = new ZipArchive();
                            $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);

                            // Create recursive directory iterator

                            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY);

                            foreach ($files as $name => $file) {
                                // Get real and relative path for current file
                                $filePath = $file->getRealPath();
                                $relativePath = substr($filePath, strlen($rootPath) + 1);

                                if (!$file->isDir()) {
                                    // Add current file to archive
                                    $zip->addFile($filePath, $relativePath);
                                } else {
                                    if ($relativePath !== false)
                                        $zip->addEmptyDir($relativePath);
                                }
                            }

                            // Zip archive will be created only after closing object
                            $zip->close();

                            // header("Content-Disposition: attachment; filename=" . $zipname);
                            // readfile($zipname);
                        } else {
                            echo "NOT COPIED";
                        }
                    }
                }
            }
            header("Content-Disposition: attachment; filename=" . $zipname);
            readfile($zipname);
        }
        if (is_dir("../assignments/" . $ChapterName)) {
            $this->deleteDir($rootPath);
        }
        // mkdir("../assignments/" . $ChapterName);
    }

    function deleteDir($dir)
    {
        if (substr($dir, strlen($dir) - 1, 1) != '/')
            $dir .= '/';

        echo $dir;

        if ($handle = opendir($dir)) {
            while ($obj = readdir($handle)) {
                if ($obj != '.' && $obj != '..') {
                    if (is_dir($dir . $obj)) {
                        if (!$this->deleteDir($dir . $obj))
                            return false;
                    } elseif (is_file($dir . $obj)) {
                        if (!unlink($dir . $obj))
                            return false;
                    }
                }
            }

            closedir($handle);

            if (!@rmdir($dir))
                return false;
            return true;
        }
        return false;
    }
    function createZipArchive($files = array(), $destination = '', $overwrite = false)
    {
        // print_die($destination);
        if (file_exists($destination) && !$overwrite) {
            return false;
        }

        $validFiles = array();
        if (is_array($files)) {
            foreach ($files as $file) {
                // print_r($file);
                if (file_exists($file)) {
                    $validFiles[] = $file;
                }
            }
        }
        //print_die($validFiles);
        if (count($validFiles)) {
            $zip = new ZipArchive();
            if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) == true) {
                foreach ($validFiles as $file) {
                    $zip->addFile($file);
                }
                $zip->close();
                // print_r($destination);
                return file_exists($destination);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    function download_assignment($chapter_id, $student_id, $class)
    {
        $files = array();
        $file_data = $this->Assignments_model->getFile($chapter_id, $student_id, $class);
        $searchVal = ' ';
        $replaceVal = '_';
        $StudentName =  str_replace($searchVal, $replaceVal, $file_data[0]['student_name']);
        // print_die($StudentName);
        if (!empty($file_data)) {
            $zipname =   $StudentName . '.zip';
            for ($i = 0; $i < count($file_data); $i++) {
                $files[$i] =   "../upload/submittedAssignments/" . $file_data[$i]['path'];
            }
            $this->createZipArchive($files, $zipname);
            header("Content-Disposition: attachment; filename=" . $zipname);
            readfile($zipname);
            unlink($zipname);
        }
    }
}
