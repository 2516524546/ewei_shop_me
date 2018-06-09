@set OPENSSL_CONF=openssl.cnf
@openssl.exe ecparam -out ec_key.pem -name secp256k1 -genkey
@openssl.exe ec -in ec_key.pem -pubout -out public.pem
