<?php

namespace G2B2G\Contracts\Eloquent\Translate;

/**
 * Provide response generating functions
 * typically used in various situtaions
 */
trait Responser {

	/**
     * Render a HTML response
     * @param  String $view View path
     * @param  Array $data Data to be passsed to view
     * @return HTTPResponse
     */
    protected function resView($tpl, $dat)
    {
        return view($tpl)->with($dat);
    }

    /**
     * Send a JSON response for API
     * @param  Array $data Data array
     * @return HTTPResponse
     */
    protected function resOutputJson($data, $code=200)
    {
    	return response()->json($data, $code);
    	//return response()->json($data, $code)->header('Content-Type', 'application/javascript');
    }

    /**
     * Send a file download response
     * @param  String  $path          File path
     * @param  boolean $forceDownload Force browser to initiate a download
     * @param  boolean $deleteFile    Whether the file should be deleted after download
     * @return HTTPResponse
     */
    protected function resDownload($path, $forceDownload = true, $deleteFile = false)
    {
    	if ($forceDownload) {
    		return response()->download($path)->deleteFileAfterSend($deleteFile);
    	}

    	return response()->file($path);
    }

    /**
     * Response with a customized status json
     * @param  Enum $status  success or error
     * @param  String $message Response message
     * @param  Mixed $data    Data to be passed along
     * @return HTTPResponse
     */
    protected function resOutput( $res, $msg='', $dat=null)
    {
        return $this->resOutputJson([
                'res' => $res,
                'msg' => $msg,
                'dat' => $dat
            ]);
    }


    protected function resSuccess($msg='', $dat=null)
    {
        return $this->resOutput(1, $msg, $dat);
    }


	protected function resAlert($msg='', $dat=null)
	{
		return $this->resOutput(0, $msg, $dat);
	}


	protected function resFail($msg='', $dat=null)
	{
		return $this->resOutput(-1, $msg, $dat);
	}

}