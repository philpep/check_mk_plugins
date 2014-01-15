<?php

$i = 0;

$special = array("SUCCESS", "TRANSFERT", "REFUSED", "NXRRSET", "NXDOMAIN");

#
# Request types per minute
#
$i++;
$def[$i]     = "";
$opt[$i]     = " --title \"Request types per minute\"";
$ds_name[$i] = "Request types per minute";
foreach ($this->DS as $KEY=>$VAL) {
    if (!(in_array($VAL['NAME'], $special))) {
        $def[$i] .= rrd::def("var".$KEY, $VAL['RRDFILE'], $VAL['DS'], "AVERAGE");
        $def[$i] .= rrd::area("var".$KEY, rrd::color($KEY), rrd::cut($VAL['NAME'], 10), 'STACK' );
        $def[$i] .= rrd::gprint("var".$KEY, array("LAST","MAX","AVERAGE"), "%6.0lf".$VAL['UNIT']);
    }
}

#
# Requests per Minute
#
$i++;
$def[$i]     = "";
$opt[$i]     = " --title \"Request status per minute\"";
$ds_name[$i] = "Request status per minute";
foreach ($this->DS as $KEY=>$VAL) {
    if (in_array($VAL['NAME'], $special)) {
        $def[$i] .= rrd::def("var".$KEY, $VAL['RRDFILE'], $VAL['DS'], "AVERAGE");
        $def[$i] .= rrd::area("var".$KEY, rrd::color($KEY), rrd::cut($VAL['NAME'], 10), 'STACK' );
        $def[$i] .= rrd::gprint("var".$KEY, array("LAST","MAX","AVERAGE"), "%6.0lf".$VAL['UNIT']);
    }
}

?>
