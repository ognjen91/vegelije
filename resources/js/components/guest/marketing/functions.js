export function shouldShow(hoursBetween = 2){
  let lastSeen = JSON.parse(localStorage.getItem('promoLastSeen'));
  if (lastSeen == null){
    let currentTime = + new Date();
    localStorage.setItem('promoLastSeen', JSON.stringify(currentTime));
    return true;
  } else {
    let nextTimeToSee = lastSeen + hoursBetween*60*60*1000;
    if(+new Date() > nextTimeToSee){
      localStorage.setItem('promoLastSeen', JSON.stringify(+new Date()));
      return true;
    }
    return false;
  }
}
