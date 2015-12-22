<?php
class panopto_auth_soap_client extends SoapClient{
    
    private $getVersionAction = "http://tempuri.org/IAuth/GetServerVersion";
    
    public function __construct($servername)
    {
        // Instantiate SoapClient in WSDL mode.
        //Set call timeout to 5 minutes.
        parent::__construct
        (
            "https://". $servername . "/Panopto/PublicAPI/4.6/Auth.svc?wsdl"
        );
    }

    /**
    * Override SOAP action to work around bug in older PHP SOAP versions.
    */
    public function __doRequest($request, $location, $action, $version, $oneway = null) {
        return parent::__doRequest($request, $location, $this->getVersionAction, $version);
    }

    public function get_server_version()
    {
        return parent::__soapCall("GetServerVersion", array());
    }
}

/* End of file panopto_auth_soap_client.php */