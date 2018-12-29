export function isEmptyObject(object) {
  for(var prop in object) {
          if(object.hasOwnProperty(prop))
              return false;
      }

      return JSON.stringify(object) === JSON.stringify({});
}
