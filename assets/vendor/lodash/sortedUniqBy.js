var baseIteratee=require("./_baseIteratee"),baseSortedUniq=require("./_baseSortedUniq");function sortedUniqBy(e,r){return e&&e.length?baseSortedUniq(e,baseIteratee(r,2)):[]}module.exports=sortedUniqBy;