const rightPanel = document.querySelector(".right-panel");

const jobCard = document.querySelectorAll(".job-card");

document.onload = GrabFirstJob();

function GrabFirstJob() {
    const jobName = document.querySelector(".job-title").textContent;
    const businessName = document.querySelector(".business-name").textContent;
    const employmentType =
        document.querySelector(".employment-type").textContent;
    const locationName = document.querySelector(".location-name").textContent;
    const postDate = document.querySelector(".job-date").textContent;
    const salaryAmount = document.querySelector(".salary").textContent;
    const jobDescription = document.querySelector(".job-desc").textContent;
    const applyButton = document
        .querySelector(".a-container > a")
        .getAttribute("href");
    const leftimg = document.getElementById("profile-photo");

    //console.log(leftimg)
    //console.log(1)
    var numJobCard = jobCard.length;
    //console.log("numjobCard: " + numJobCard);
    for (var i = 0; i < numJobCard; i++) {
        jobCard[i].addEventListener("click", jobClick);
        //console.log("Index: " + i);
    }

    rightPanel.querySelector(".r-company-name").textContent = businessName;
    rightPanel.querySelector(".r-location").textContent = locationName;
    rightPanel.querySelector(".r-job-title").textContent = jobName;
    rightPanel.querySelector(".r-job-type").textContent = employmentType;
    rightPanel.querySelector(".r-job-date").textContent = postDate;
    rightPanel.querySelector(".r-salary").textContent =
        salaryAmount + " Per Hour";
    //Commented out because it was overwrtting the job description
    //rightPanel.querySelector('.r-job-desc').textContent = jobDescription;
    var a = rightPanel.querySelector(".a-div > a");
    const rightimg = (document.getElementById("job-image").src = leftimg.src);

    a.href = applyButton;
}

function jobClick(e) {
    const jobName = e.currentTarget.querySelector(".job-title").textContent;
    const businessName =
        e.currentTarget.querySelector(".business-name").textContent;
    const employmentType =
        e.currentTarget.querySelector(".employment-type").textContent;
    const locationName =
        e.currentTarget.querySelector(".location-name").textContent;
    const postDate = e.currentTarget.querySelector(".job-date").textContent;
    const salaryAmount = e.currentTarget.querySelector(".salary").textContent;
    const jobDescription =
        e.currentTarget.querySelector(".job-desc").textContent;
    const applyButton = e.currentTarget
        .querySelector(".a-container > a")
        .getAttribute("href");
    const leftimg = e.currentTarget.querySelector("#profile-photo");

    rightPanel.querySelector(".r-company-name").textContent = businessName;
    rightPanel.querySelector(".r-location").textContent = locationName;
    rightPanel.querySelector(".r-job-title").textContent = jobName;
    rightPanel.querySelector(".r-job-type").textContent = employmentType;
    rightPanel.querySelector(".r-job-date").textContent = postDate;
    rightPanel.querySelector(".r-salary").textContent =
        salaryAmount;
    //Commented out because it was overwrtting the job description
    //rightPanel.querySelector('.r-job-desc').textContent = jobDescription;
    document.getElementById("hidden-job-description").value = jobDescription;
    document.getElementById("job-image").src = leftimg.src;
    //console.log("JOB CLIOCKED");

    var a = rightPanel.querySelector(".a-div > a");

    a.href = applyButton;

    //console.log(jobName,businessName,employmentType,locationName)
}
