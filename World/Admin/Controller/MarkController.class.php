<?php
namespace Admin\Controller;

use Index\Model\FirstMarkModel;
use Index\Model\FourthMarkModel;
use Index\Model\SecondMarkModel;
use Index\Model\ThirdMarkModel;
use Think\Controller;
use Think\Exception;

class MarkController extends CommonController {

    //第一层标签列表
    public function mark_list(){

        $mid = $_GET['mid'];
        $type = $_GET['type'];

        $firstmarkmodel = new FirstMarkModel();

        $marklist = $firstmarkmodel->findlist('first_mark_mid = '.$mid.' and first_mark_type = '.$type);

        $this->assign(array(
            'mid' => $mid,
            'type' => $type,
            'marklist' => $marklist,
        ));
		$this->display();
	}

	//第一层标识修改
    public function ajax_firstedit(){

        if (IS_POST) {

            $fid = $_POST['fid'];
            $name = $_POST['name'];
            $data = array(
                'firsth_mark_name'=>$name,
            );
            $firstmarkmodel = new FirstMarkModel();

            $res = $firstmarkmodel->updataone('first_mark_id = '.$fid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //第二层标识列表
    public function second_list(){
        $fid = $_GET['fid'];

        $firstmarkmodel = new FirstMarkModel();
        $secondmarkmodel = new SecondMarkModel();

        $firstone = $firstmarkmodel->findone('first_mark_id = '.$fid);
        $secondcount = $secondmarkmodel->findone('second_mark_fid = '.$fid,'count(*) num')['num'];

        $Page = new \Think\Page($secondcount,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $secondlist = $secondmarkmodel->findlimit('second_mark_fid = '.$fid,$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'firstone' => $firstone,
            'secondlist'=> $secondlist,
            'page' => $show,

        ));
        $this->display();

    }

    //添加第二标识
    public function ajax_secondadd(){
        if (IS_POST) {

            $fid = $_POST['fid'];
            $name = $_POST['name'];

            $secondmarkmodel = new SecondMarkModel();

            $secondone = $secondmarkmodel->findone('second_mark_fid = '.$fid);
            $isextend = 0;
            if ($secondone){
                $isextend = $secondone['second_mark_isextend'];
            }

            $data = array(
                'second_mark_fid'=>$fid,
                'second_mark_name'=>$name,
                'second_mark_isextend'=>$isextend,
                'second_mark_createtime'=>date("Y-m-d H:i:s", time()),
            );

            $res = $secondmarkmodel->add($data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_addok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_addno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //删除第二标识
    public function ajax_seconddel(){
        if (IS_POST) {

            $sid = $_POST['sid'];

            $secondmarkmodel = new SecondMarkModel();

            $data = array('second_mark_id'=>$sid);
            $res = $secondmarkmodel->where($data)->delete();
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_delok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //修改第二标签
    public function ajax_secondedit(){

        if (IS_POST) {

            $sid = $_POST['sid'];
            $name = $_POST['name'];
            $data = array(
                'second_mark_name'=>$name,
            );
            $secondmarkmodel = new SecondMarkModel();

            $res = $secondmarkmodel->updataone('second_mark_id = '.$sid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //扩充第二标签
    public function ajax_secondextend(){

        if (IS_POST) {

            $fid = $_POST['fid'];

            $data = array(
                'second_mark_isextend'=>1,
            );
            $secondmarkmodel = new SecondMarkModel();

            $res = $secondmarkmodel->updataone('second_mark_fid = '.$fid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_extendok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_extendno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //第三层标识列表
    public function third_list(){
        $sid = $_GET['sid'];

        $firstmarkmodel = new FirstMarkModel();
        $secondmarkmodel = new SecondMarkModel();
        $thirdmarkmodel = new ThirdMarkModel();

        $secondone = $secondmarkmodel->findone('second_mark_id = '.$sid);
        $firstone = $firstmarkmodel->findone('first_mark_id = '.$secondone['second_mark_fid']);
        $thirdcount = $thirdmarkmodel->findone('third_mark_sid = '.$sid,'count(*) num')['num'];

        $Page = new \Think\Page($thirdcount,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $thirdlist = $thirdmarkmodel->findlimit('third_mark_sid = '.$sid,$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'firstone' => $firstone,
            'secondone' => $secondone,
            'thirdlist'=> $thirdlist,
            'page' => $show,

        ));
        $this->display();

    }

    //添加第三标识
    public function ajax_thirdadd(){
        if (IS_POST) {

            $sid = $_POST['sid'];
            $name = $_POST['name'];

            $thirdmarkmodel = new ThirdMarkModel();

            $thirdone = $thirdmarkmodel->findone('third_mark_sid = '.$sid);
            $isextend = 0;
            if ($thirdone){
                $isextend = $thirdone['third_mark_isextend'];
            }

            $data = array(
                'third_mark_sid'=>$sid,
                'third_mark_name'=>$name,
                'third_mark_isextend'=>$isextend,
                'third_mark_createtime'=>date("Y-m-d H:i:s", time()),
            );

            $res = $thirdmarkmodel->add($data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_addok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_addno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //删除第三标识
    public function ajax_thirddel(){
        if (IS_POST) {

            $tid = $_POST['tid'];

            $thirdmarkmodel = new ThirdMarkModel();

            $data = array('third_mark_id'=>$tid);
            $res = $thirdmarkmodel->where($data)->delete();
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_delok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //修改第三标签
    public function ajax_thirdedit(){

        if (IS_POST) {

            $tid = $_POST['tid'];
            $name = $_POST['name'];
            $data = array(
                'third_mark_name'=>$name,
            );
            $thirdmarkmodel = new ThirdMarkModel();

            $res = $thirdmarkmodel->updataone('third_mark_id = '.$tid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //扩充第三标签
    public function ajax_thirdextend(){

        if (IS_POST) {

            $sid = $_POST['sid'];

            $data = array(
                'third_mark_isextend'=>1,
            );
            $thirdmarkmodel = new ThirdMarkModel();

            $res = $thirdmarkmodel->updataone('third_mark_sid = '.$sid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_extendok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_extendno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //第四层标识列表
    public function fourth_list(){
        $tid = $_GET['tid'];

        $firstmarkmodel = new FirstMarkModel();
        $secondmarkmodel = new SecondMarkModel();
        $thirdmarkmodel = new ThirdMarkModel();
        $fourthmarkmodel = new FourthMarkModel();

        $thirdone = $thirdmarkmodel->findone('third_mark_id = '.$tid);
        $secondone = $secondmarkmodel->findone('second_mark_id = '.$thirdone['third_mark_sid']);
        $firstone = $firstmarkmodel->findone('first_mark_id = '.$secondone['second_mark_fid']);
        $fourthcount = $fourthmarkmodel->findone('fourth_mark_tid = '.$tid,'count(*) num')['num'];

        $Page = new \Think\Page($fourthcount,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $fourthlist = $fourthmarkmodel->findlimit('fourth_mark_tid = '.$tid,$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'firstone' => $firstone,
            'secondone' => $secondone,
            'thirdone' => $thirdone,
            'fourthlist'=> $fourthlist,
            'page' => $show,

        ));
        $this->display();

    }

    //添加第四标识
    public function ajax_fourthadd(){
        if (IS_POST) {

            $tid = $_POST['tid'];
            $name = $_POST['name'];

            $fourthmarkmodel = new FourthMarkModel();

            $fourthone = $fourthmarkmodel->findone('fourth_mark_tid = '.$tid);
            $isextend = 0;
            if ($fourthone){
                $isextend = $fourthone['fourth_mark_isextend'];
            }

            $data = array(
                'fourth_mark_tid'=>$tid,
                'fourth_mark_name'=>$name,
                'fourth_mark_isextend'=>$isextend,
                'fourth_mark_createtime'=>date("Y-m-d H:i:s", time()),
            );

            $res = $fourthmarkmodel->add($data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_addok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_addno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //删除第四标识
    public function ajax_fourthdel(){
        if (IS_POST) {

            $fid = $_POST['fid'];

            $fourthmarkmodel = new FourthMarkModel();

            $data = array('fourth_mark_id'=>$fid);
            $res = $fourthmarkmodel->where($data)->delete();
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_delok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //修改第四标签
    public function ajax_fourthedit(){

        if (IS_POST) {

            $fid = $_POST['fid'];
            $name = $_POST['name'];
            $data = array(
                'fourth_mark_name'=>$name,
            );
            $fourthmarkmodel = new FourthMarkModel();

            $res = $fourthmarkmodel->updataone('fourth_mark_id = '.$fid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //第二标识导入
    public function haveExcel(){

        if (IS_POST) {

            $fid = $_POST['fid'];
            $file = $_FILES['daofile'];

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3072000 ;// 设置附件上传大小
            $upload->exts = array('xls', 'xlsx');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
// 上传单个文件
            $info = $upload->uploadOne($file);
            if(!$info) {// 上传错误提示错误信息
                die(json_encode(array('str' => 0,'msg'=>$upload->getError())));
            }else {// 上传成功 获取上传文件信息
                //return $info;
                //die(json_encode(array('str' => 1,'msg'=>$info)));
                $exts = $info['ext'];
                $filename = './Uploads/' . $info['savepath'] . $info['savename'];

                import("Org.Util.PHPExcel");
                //不同类型的文件导入不同的类
                if ($exts == 'xls') {
                    import("Org.Util.PHPExcel.Reader.Excel5");
                    $PHPReader = new \PHPExcel_Reader_Excel5();
                } else if ($exts == 'xlsx') {
                    import("Org.Util.PHPExcel.Reader.Excel2007");
                    $PHPReader = new \PHPExcel_Reader_Excel2007();
                }
                import("Org.Util.PHPExcel.Reader.Excel2007");
                $PHPReader = new \PHPExcel_Reader_Excel2007();
                //载入文件
                $PHPExcel = $PHPReader->load($filename);
                //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
                $currentSheet = $PHPExcel->getSheet(0);
                //获取总列数
                $allColumn = $currentSheet->getHighestColumn();
                //获取总行数
                $allRow = $currentSheet->getHighestRow();
                //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
                for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
                    //从哪列开始，A表示第一列
                    for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                        //数据坐标
                        $address = $currentColumn . $currentRow;
                        //读取到的数据，保存到数组$arr中
                        $data[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
                    }
                }
            }

            $secondmarkmodel = new SecondMarkModel();
            $secondone = $secondmarkmodel->findone('second_mark_isextend = 1 and second_mark_fid = '.$fid);
            $isextend = 0;
            if ($secondone){
                $isextend = 1;
            }
            $secondmarkmodel->startTrans();
            try {
                foreach ($data as $e) {
                    $data = array(
                        'second_mark_fid' => $fid,
                        'second_mark_name' => $e['A'],
                        'second_mark_isextend' => $isextend,
                        'second_mark_createtime' => date("Y-m-d H:i:s", time()),
                    );

                    $secondmarkmodel->add($data);
                }
                $secondmarkmodel->commit();
                die(json_encode(array('str' => 1,'msg'=>L('Mark_second_list_dao_succress'))));
            }catch (Exception $e){
                $secondmarkmodel->rollback();
                die(json_encode(array('str' => 0,'msg'=>L('Mark_second_list_dao_fail'))));
            }



        } else {

            die(json_encode(array('str' => 0)));
        }



    }

    //第三标识导入
    public function haveExcelthree(){

        if (IS_POST) {

            $sid = $_POST['sid'];
            $file = $_FILES['daofile'];

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3072000 ;// 设置附件上传大小
            $upload->exts = array('xls', 'xlsx');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
// 上传单个文件
            $info = $upload->uploadOne($file);
            if(!$info) {// 上传错误提示错误信息
                die(json_encode(array('str' => 0,'msg'=>$upload->getError())));
            }else {// 上传成功 获取上传文件信息
                //return $info;
                //die(json_encode(array('str' => 1,'msg'=>$info)));
                $exts = $info['ext'];
                $filename = './Uploads/' . $info['savepath'] . $info['savename'];

                import("Org.Util.PHPExcel");
                //不同类型的文件导入不同的类
                if ($exts == 'xls') {
                    import("Org.Util.PHPExcel.Reader.Excel5");
                    $PHPReader = new \PHPExcel_Reader_Excel5();
                } else if ($exts == 'xlsx') {
                    import("Org.Util.PHPExcel.Reader.Excel2007");
                    $PHPReader = new \PHPExcel_Reader_Excel2007();
                }
                import("Org.Util.PHPExcel.Reader.Excel2007");
                $PHPReader = new \PHPExcel_Reader_Excel2007();
                //载入文件
                $PHPExcel = $PHPReader->load($filename);
                //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
                $currentSheet = $PHPExcel->getSheet(0);
                //获取总列数
                $allColumn = $currentSheet->getHighestColumn();
                //获取总行数
                $allRow = $currentSheet->getHighestRow();
                //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
                for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
                    //从哪列开始，A表示第一列
                    for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                        //数据坐标
                        $address = $currentColumn . $currentRow;
                        //读取到的数据，保存到数组$arr中
                        $data[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
                    }
                }
            }

            $thirdmarkmodel = new ThirdMarkModel();
            $thirdone = $thirdmarkmodel->findone('third_mark_isextend = 1 and third_mark_sid = '.$sid);
            $isextend = 0;
            if ($thirdone){
                $isextend = 1;
            }
            $thirdmarkmodel->startTrans();
            try {
                foreach ($data as $e) {
                    $data = array(
                        'third_mark_sid' => $sid,
                        'third_mark_name' => $e['A'],
                        'third_mark_isextend' => $isextend,
                        'third_mark_createtime' => date("Y-m-d H:i:s", time()),
                    );

                    $thirdmarkmodel->add($data);
                }
                $thirdmarkmodel->commit();
                die(json_encode(array('str' => 1,'msg'=>L('Mark_second_list_dao_succress'))));
            }catch (Exception $e){
                $thirdmarkmodel->rollback();
                die(json_encode(array('str' => 0,'msg'=>L('Mark_second_list_dao_fail'))));
            }


        } else {

            die(json_encode(array('str' => 0)));
        }



    }

    //第四标识导入
    public function haveExcelfour(){

        if (IS_POST) {

            $tid = $_POST['tid'];
            $file = $_FILES['daofile'];

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3072000 ;// 设置附件上传大小
            $upload->exts = array('xls', 'xlsx');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
// 上传单个文件
            $info = $upload->uploadOne($file);
            if(!$info) {// 上传错误提示错误信息
                die(json_encode(array('str' => 0,'msg'=>$upload->getError())));
            }else {// 上传成功 获取上传文件信息
                //return $info;
                //die(json_encode(array('str' => 1,'msg'=>$info)));
                $exts = $info['ext'];
                $filename = './Uploads/' . $info['savepath'] . $info['savename'];

                import("Org.Util.PHPExcel");
                //不同类型的文件导入不同的类
                if ($exts == 'xls') {
                    import("Org.Util.PHPExcel.Reader.Excel5");
                    $PHPReader = new \PHPExcel_Reader_Excel5();
                } else if ($exts == 'xlsx') {
                    import("Org.Util.PHPExcel.Reader.Excel2007");
                    $PHPReader = new \PHPExcel_Reader_Excel2007();
                }
                import("Org.Util.PHPExcel.Reader.Excel2007");
                $PHPReader = new \PHPExcel_Reader_Excel2007();
                //载入文件
                $PHPExcel = $PHPReader->load($filename);
                //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
                $currentSheet = $PHPExcel->getSheet(0);
                //获取总列数
                $allColumn = $currentSheet->getHighestColumn();
                //获取总行数
                $allRow = $currentSheet->getHighestRow();
                //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
                for ($currentRow = 1; $currentRow <= $allRow; $currentRow++) {
                    //从哪列开始，A表示第一列
                    for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                        //数据坐标
                        $address = $currentColumn . $currentRow;
                        //读取到的数据，保存到数组$arr中
                        $data[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
                    }
                }
            }

            $fourthmarkmodel = new FourthMarkModel();
            $fourthone = $fourthmarkmodel->findone('fourth_mark_isextend = 1 and fourth_mark_tid = '.$tid);
            $isextend = 0;
            if ($fourthone){
                $isextend = 1;
            }
            $fourthmarkmodel->startTrans();
            try {
                foreach ($data as $e) {
                    $data = array(
                        'fourth_mark_tid' => $tid,
                        'fourth_mark_name' => $e['A'],
                        'fourth_mark_isextend' => $isextend,
                        'fourth_mark_createtime' => date("Y-m-d H:i:s", time()),
                    );

                    $fourthmarkmodel->add($data);
                }
                $fourthmarkmodel->commit();
                die(json_encode(array('str' => 1,'msg'=>L('Mark_second_list_dao_succress'))));
            }catch (Exception $e){
                $fourthmarkmodel->rollback();
                die(json_encode(array('str' => 0,'msg'=>L('Mark_second_list_dao_fail'))));
            }



        } else {

            die(json_encode(array('str' => 0)));
        }
    }


    public function second_delsum(){
        if (IS_POST) {

            $fid = $_POST['fid'];
            $secondmarkmodel = new SecondMarkModel();
            $res = $secondmarkmodel->where('second_mark_fid = '.$fid)->delete();
            if ($res){
                die(json_encode(array('str' => 1,'msg'=>'删除成功')));
            }else{
                die(json_encode(array('str' => 2,'msg'=>'删除失败')));
            }


        } else {

            die(json_encode(array('str' => 0)));
        }
    }
	
}