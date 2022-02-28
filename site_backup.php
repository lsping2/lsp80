 #!/usr/local/php/bin/php
<?

$term = 14; // Days
$backup_dir = "backup";

$today_date     = date( 'Ymd' , time() );
$today_hour     = date( 'H' , time() );

$old_week       = mktime( 0, 0, 0, date( "m" ), date( "d" ) - $term, date( "Y" ) );
$old_date       = date( 'Ymd' , $old_week );


// Site Home Directory
$home_array     = array (
                                'lsp' ,
				'kke'
                        );


// Delete
`rm -rf {$backup_dir}/{$old_date}`;
`rm -rf {$backup_dir}/{$today_date}`;

`mkdir -p {$backup_dir}/{$today_date}`;


foreach( $home_array as $home_name )
{


	`mkdir -p {$backup_dir}/{$today_date}/{$home_name}`;

    $dat_file = "backup_list.dat";
        if( is_file( $dat_file ) )
        {

                $fp = fopen( $dat_file, "r" );
                while( !feof( $fp ) )
                {
                        $line = fgets( $fp, 4096 );
                        $line = str_replace( "\n", "", $line );
                        $line = str_replace( "\r", "", $line );
	
                        if( $line )
                        {
                                // `tar rvf {$backup_dir}/{$today_date}/{$home_name}.tar /home/{$home_name}/www/{$line}`;
                              `cp -R {$home_name}/{$line} {$backup_dir}/{$today_date}/{$home_name}/{$line}`;
				echo "<br>";
                        }
                }
        }

	// `gzip -9 {$backup_dir}/{$today_date}/{$home_name}.tar`;

}

?>
backup ม๘วเ.
