function save(sem){
    const save= document.getElementById('saveEvalData');
    const data= document.getElementById('saveData')
 
    const monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
      ];
      
      // Get the current date
      const currentDate = new Date();
      
      // Extract date parts
      const day = currentDate.getDate();
      const month = currentDate.getMonth(); // Note: Month is 0-indexed
      const year = currentDate.getFullYear();
      
      // Convert month to its corresponding word form
      const monthInWords = monthNames[month];
      
      // Create the formatted date string
      const formattedDate = `${day}-${monthInWords}-${year}`;
      
    save.style.display='';
    data.value= formattedDate +"-"+ sem + "-Semester";
}

