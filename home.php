<?php
include "config.php";

// Check user login or not
if(empty($_SESSION['username'])){
    header('Location: index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');
}

?>

<!doctype html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <body>
        <h1>Welcome <?php echo $_SESSION['username']  ?></h1>
        <p>We are now analyzing your browser fingerprints!</p>
        <form method='post' action="">
            <input type="submit" value="Logout" name="but_logout">
        </form>
    </body>
</html>

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function(event) {

        var bInfo = new Array();

        // # ScreenInfo
        var screenInfo = (screen.width + " " + screen.height + " " + screen.colorDepth + " " + screen.availWidth + " " + screen.availHeight).toString();
        bInfo.push(screenInfo)

        // # IsJavaEnabled
        var hasJava = "Has java: " + navigator.javaEnabled().toString();
        bInfo.push(hasJava)

        // # Plugin List
        var allPlugins = "";
        var pluginLength = navigator.plugins.length;
        for (var i=0; i<pluginLength; i++) {
            allPlugins += navigator.plugins[i].name; 
        }
        bInfo.push(allPlugins)

        // # User Agent
        var userAgent = navigator.userAgent;
        bInfo.push(userAgent)

        // # Browser Permissions
        allPermissions = "";
        (async function () {
            allPermissions = await getBrowserPermissions()
            bInfo.push(allPermissions)
        })()
        
        // # Navigator Properties
        var numberOfProperties = Object.keys(Object.getPrototypeOf(navigator)).length.toString() + " properties";
        bInfo.push(numberOfProperties)

        // # Canvas Information
        var canvas = document.createElement('canvas');
        var canvasgl = canvas.getContext("experimental-webgl");
        var canvasdebug = canvasgl.getExtension('WEBGL_debug_renderer_info');
        var webglinfo = canvasgl.getParameter(canvasdebug.UNMASKED_VENDOR_WEBGL) 
            + " " + canvasgl.getParameter(canvasdebug.UNMASKED_RENDERER_WEBGL);
        bInfo.push(webglinfo)

        // # IP Address
        // Do this at the end, so inside the getJSON function we can make hash.
        var ipString = "";
        $.getJSON('https://httpbin.org/ip', function(data) {
            ipstring = data['origin'];
            bInfo.push(ipstring)

            var userid = '<?php echo $_SESSION['uid'];?>';
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open( "GET", "http://localhost/simple-fingerprint/submitfp.php?1=" + userid + "&2=" + bInfo[0] + "&3=" + bInfo[1] + "&4=" + bInfo[2] 
                + "&5=" + bInfo[3] + "&6=" + bInfo[4] + "&7=" + bInfo[5] + "&8=" + bInfo[6] + "&9=" + bInfo[7] + "&intent=insert", false ); // false for synchronous request
            xmlHttp.send( null );
        });

        console.log(bInfo);
    });

    const permissionsNames = [ "geolocation",
    "notifications",
    "push",
    "midi",
    "camera",
    "microphone",
    "speaker",
    "device-info",
    "background-fetch",
    "background-sync",
    "bluetooth",
    "persistent-storage",
    "ambient-light-sensor",
    "accelerometer",
    "gyroscope",
    "magnetometer",
    "clipboard",
    "display-capture",
    "nfc"
    ]

    const getBrowserPermissions = async () => {
    var allPermissions = "";
    await Promise.all(
        permissionsNames.map(async permissionName => {
            try {
            let permission
            switch (permissionName) {
                case 'push':
                permission = await navigator.permissions.query({name: permissionName, userVisibleOnly: true})
                break
                default:
                permission = await navigator.permissions.query({name: permissionName})
            }
            allPermissions += permissionName + " " + permission.state
            }
            catch(e){
            allPermissions += permissionName + " error"
            }
        })
    )
        return allPermissions
    }

</script>