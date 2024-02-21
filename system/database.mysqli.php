<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org
[BEGIN_SED]
File=system/database.mysqli.php
Version=179
Updated=2022-jul-15
Type=Core
Author=Seditio Team
Description=Functions MySQLi driver
[END_SED]
==================== */

if (!defined('SED_CODE')) {
	die('Wrong URL.');
}

mysqli_report(MYSQLI_REPORT_OFF);

/* ------------------ */

if (function_exists('mysqli_set_charset') === false) {

	function mysqli_set_charset($conn_id, $charset)
	{
		return mysqli_query($conn_id, 'SET NAMES "' . $charset . '"');
	}
}

/** 
 * Gets the number of affected rows in a previous MySQL 
 *   
 * @param mysqli $conn_id The MySQL connection link identifier 
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return int Number of rows affected by the last INSERT, UPDATE, REPLACE or DELETE query.  
 */
function sed_sql_affectedrows($conn_id = null)
{
	global $connection_id;
	return is_null($conn_id) ? mysqli_affected_rows($connection_id) : mysqli_affected_rows($conn_id);
}

/** 
 * Сloses the non-persistent connection to the MySQL server that's associated with the specified link identifier.
 * 
 * @param mysqli $conn_id The MySQL connection link identifier   
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return bool Returns TRUE on success or FALSE on failure.  
 */
function sed_sql_close($conn_id = null)
{
	global $connection_id;
	return is_null($conn_id) ? mysqli_close($connection_id) : mysqli_close($conn_id);
}

/** 
 * Open a connection to a MySQL Server & Select a MySQL database
 * 
 * @param string $host The MySQL server. It can also include a port number. e.g. "hostname:port" or a path to a local socket e.g. ":/path/to/socket" for the localhost.
 * @param string $user The username
 * @param string $pass The password
 * @param string $db The name of the database that is to be selected.     
 * @return mysqli|bool Specified link identifier  
 */
function sed_sql_connect($host, $user, $pass, $db)
{
	$conn_id = @mysqli_connect($host, $user, $pass, $db);
	if (mysqli_connect_errno() || empty($db)) {
		sed_diefatal('Connect failed. Please check your settings in the file datas/config.php. ' . mysqli_connect_error());
	}
	return ($conn_id);
}

/** 
 * Returns the error number from the last MySQL function.
 * 
 * @param mysqli $conn_id The MySQL connection link identifier    
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return int Returns the error number from the last MySQL function, or 0 (zero) if no error occurred.  
 */
function sed_sql_errno($conn_id = null)
{
	global $connection_id;
	return is_null($conn_id) ? mysqli_errno($connection_id) : mysqli_errno($conn_id);
}

/** 
 * Returns the error text from the last MySQL function.
 *   
 * @param mysqli $conn_id The MySQL connection link identifier  
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return string Returns the error text from the last MySQL function, or '' (empty string) if no error occurred.  
 */
function sed_sql_error($conn_id = null)
{
	global $connection_id;
	return is_null($conn_id) ? mysqli_error($connection_id) : mysqli_error($conn_id);
}

/** 
 * Returns an array that corresponds to the fetched row and moves the internal data pointer ahead.
 *   
 * @param mysqli_result $res The result resource that is being evaluated. This result comes from a call to sed_sql_query(). 
 * @return array|bool Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.  
 */
function sed_sql_fetcharray($res)
{
	return (mysqli_fetch_array($res));
}

/** 
 * Returns an associative array that corresponds to the fetched row and moves the internal data pointer ahead.
 *   
 * @param mysqli_result $res The result resource that is being evaluated. This result comes from a call to sed_sql_query(). 
 * @return array|bool Returns an associative array of strings that corresponds to the fetched row, or FALSE if there are no more rows.  
 */
function sed_sql_fetchassoc($res)
{
	return (mysqli_fetch_assoc($res));
}

/** 
 * Returns a numerical array that corresponds to the fetched row and moves the internal data pointer ahead.
 *   
 * @param mysqli_result $res The result resource that is being evaluated. This result comes from a call to sed_sql_query(). 
 * @return array|bool Returns an numerical array of strings that corresponds to the fetched row, or FALSE if there are no more rows.  
 */
function sed_sql_fetchrow($res)
{
	return (mysqli_fetch_row($res));
}

/** 
 * Returns an object containing field information. This function can be used to obtain information about fields in the provided query result.
 *   
 * @param mysqli_result $res The result resource that is being evaluated. This result comes from a call to sed_sql_query(). 
 * @return resource|bool an object containing field information  
 */
function sed_sql_fetchfield($res, $field_offset = 0)
{
	return (mysqli_fetch_field($res));
}

/** 
 * Retrieves the number of fields from a query.
 *   
 * @param mysqli_result $res The result resource that is being evaluated. This result comes from a call to sed_sql_query(). 
 * @return int the number of fields in the result set resource on success or FALSE on failure.
 */
function sed_sql_numfields($res)
{
	return (mysqli_num_fields($res));
}

/** 
 * Free result memory
 *   
 * @param mysqli_result $res The result resource that is being evaluated. This result comes from a call to sed_sql_query(). 
 * @return bool Returns TRUE on success or FALSE on failure.  
 */
function sed_sql_freeresult($res)
{
	return (mysqli_free_result($res));
}

/** 
 * Get the ID generated in the last query
 * 
 * Retrieves the ID generated for an AUTO_INCREMENT column by the previous query (usually INSERT).  
 *   
 * @param mysqli $conn_id The MySQL connection link identifier  
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return int|bool The ID generated for an AUTO_INCREMENT column by the previous query on success, 0 if the previous query does not generate an AUTO_INCREMENT value, or FALSE if no MySQL connection was established. 
 */
function sed_sql_insertid($conn_id = null)
{
	global $connection_id;
	return is_null($conn_id) ? mysqli_insert_id($connection_id) : mysqli_insert_id($conn_id);
}

/** 
 * Display a list tables in a MySQL database
 *  
 * @param string $res Selected database or command e.g. [db_name] [LIKE 'pattern' | WHERE expr]  
 * @param mysqli $conn_id The MySQL connection link identifier  
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return string List tables in a MySQL database 
 */
function sed_sql_listtables($res, $conn_id = null)
{
	global $connection_id;
	$conn_id = is_null($conn_id) ? $connection_id : $conn_id;
	$res = mysqli_query($conn_id, "SHOW TABLES FROM " . $res . " ");
	return ($res);
}

/** 
 * Get number of rows in result
 * 
 * Retrieves the number of rows from a result set. This command is only valid 
 * for statements like SELECT or SHOW that return an actual result set. 
 * To retrieve the number of rows affected by a INSERT, UPDATE, REPLACE or DELETE query, use sed_sql_affectedrows().  
 *   
 * @param mysqli_result $res The result resource that is being evaluated. This result comes from a call to sed_sql_query(). 
 * @return int|bool The number of rows in a result set on success or FALSE on failure.  
 */
function sed_sql_numrows($res)
{
	return (mysqli_num_rows($res));
}

/** 
 * Escapes a string for use in a mysql_query
 *  
 * @param string $res The string that is to be escaped.  
 * @param mysqli $conn_id The MySQL connection link identifier  
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return string Returns the escaped string.
 */
function sed_sql_prep($res, $conn_id = null)
{
	global $connection_id;
	if (empty($res)) return ($res);
	return is_null($conn_id) ? mysqli_real_escape_string($connection_id, $res) : mysqli_real_escape_string($conn_id, $res);
}

/** 
 * Send a MySQL query & build sql statistics
 *  
 * @param string $query An SQL query
 * @param bool $halterr Show SQL error 
 * @param mysqli $conn_id The MySQL connection link identifier  
 * @global mysqli $connection_id A link identifier returned by sed_sql_connect()
 * @return mixed Returns a resource on success, or FALSE on error for SELECT, SHOW, DESCRIBE, EXPLAIN. Returns TRUE on success or FALSE on error for INSERT, UPDATE, DELETE, DROP
 */
function sed_sql_query($query, $halterr = true, $conn_id = null)
{
	global $sys, $cfg, $connection_id;

	$conn_id = is_null($conn_id) ? $connection_id : $conn_id;

	$sys['qcount'] = 0;
	$sys['tcount'] = 0;
	$sys['qcount']++;
	$xtime = microtime();

	if ($halterr) {
		$result = mysqli_query($conn_id, $query) or sed_diefatal('SQL error : ' . sed_sql_error());
	} else {
		$result = mysqli_query($conn_id, $query);
	}

	$ytime = microtime();
	$xtime = explode(' ', $xtime);
	$ytime = explode(' ', $ytime);
	$sys['tcount'] = $sys['tcount'] + $ytime[1] + $ytime[0] - $xtime[1] - $xtime[0];
	if ($cfg['devmode']) {
		$sys['devmode']['queries'][] = array($sys['qcount'], $ytime[1] + $ytime[0] - $xtime[1] - $xtime[0], $query);
		$sys['devmode']['timeline'][] = $xtime[1] + $xtime[0] - $sys['starttime'];
	}
	return ($result);
}

/** 
 * Get result data
 * 
 * Retrieves the contents of one cell from a MySQL result set.  
 *  
 * @param resource $result The result resource that is being evaluated. This result comes from a call to mysql_query().
 * @param int $row The row number from the result that's being retrieved. Row numbers start at 0.
 * @param mixed $col The name or offset of the field being retrieved.  
 * @return string The contents of one cell from a MySQL result set on success, or FALSE on failure.
 */
function sed_sql_result($res, $row, $col = 0)
{
	mysqli_data_seek($res, $row);
	$result = mysqli_fetch_array($res);
	return ($result[$col]);
}

/** 
 * Sets the client character set
 * 
 * Sets the default character set for the current connection. 
 *   
 * @param string $charset A valid character set name.
 * @param mysqli $conn_id The MySQL connection link identifier 
 * @return bool Returns TRUE on success or FALSE on failure.  
 */
function sed_sql_set_charset($conn_id, $charset)
{
	return (mysqli_set_charset($conn_id, $charset));
}

/** 
 * Returns count of rows in table.
 *   
 * @param string $table Name of table.
 * @return string Count of rows in table.  
 */
function sed_sql_rowcount($table)
{
	$sqltmp = sed_sql_query("SELECT COUNT(*) FROM $table");
	return (sed_sql_result($sqltmp, 0, "COUNT(*)"));
}
