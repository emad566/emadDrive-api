
    (function() {
        // Initialize the Firebase SDK
        firebase.initializeApp({
            apiKey: "AIzaSyBusP2l58G95J518C_9gKznVSv4j5DqHCs",
            databaseURL: "https://AtmoDrive-65292-default-rtdb.firebaseio.com",
            projectId: "AtmoDrive-65292"
        });
      
     
        var firebaseRef = firebase.database().ref('OnlineCaptains');

     
        // var geoFireInstance = new geofire.GeoFire(firebaseRef);
        // var ref = geoFireInstance.ref();  // ref === firebaseRef
        // console.log(ref);

        var geoFireInstance = new geofire.GeoFire(firebaseRef);

        var geoQuery = geoFireInstance.query({
            center: [37.79, -122.41],
            radius: 20.5
          });
          var radius = geoQuery.radius();  // radius === 10.5
          var center = geoQuery.center();  // center === [10.38, 2.41]

        
          geoFireInstance.set("some_key", [37.79, -122.41]).then(function() {
            console.log("Provided key has been added to GeoFire");
          }, function(error) {
            console.log("Error: " + error);
          });
          console.log(geoQuery);

      
      })();