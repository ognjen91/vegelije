// ubacujem objekat u obliku {name:similarity}
export function sortNamesBySimilarity(nameSimilarityObject) {
  var sortable = [];
  for (var name in nameSimilarityObject) {
    sortable.push([name, nameSimilarityObject[name]]);
}
let sorted = sortable.sort(function(a, b) {
    return a[1] - b[1];
});

//da bi se vracali prvo rezultati sa najvecom slicoscu
sorted = sorted.reverse();


//da vratim niz objekata
let sortedObjectsArray = {};
for (var x in sorted){
  sortedObjectsArray[sorted[x][0]] = sorted[x][1]
}

return sortedObjectsArray;
}
