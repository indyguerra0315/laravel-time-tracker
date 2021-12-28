window.generateUuid = function ()
{
    var seed = Date.now();
    if (window.performance && typeof window.performance.now === "function") {
        seed += performance.now();
    }

    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = (seed + Math.random() * 16) % 16 | 0;
        seed = Math.floor(seed/16);

        return (c === 'x' ? r : r & (0x3|0x8)).toString(16);
    });

    return uuid;
}

window.getStringDateNow = function () {
    let date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    let hour = date.getHours();
    let minute = date.getMinutes();
    let seconds = date.getSeconds();

    const monthString = month < 10 ? '0'+month : month;
    const dayString = day < 10 ? '0'+day : day;
    const hourString = hour < 10 ? '0'+hour : hour;
    const minuteString = minute < 10 ? '0'+minute : minute;
    const secondsString = seconds < 10 ? '0'+seconds : seconds;

    return `${year}-${monthString}-${dayString} ${hourString}:${minuteString}:${secondsString}`;
};
