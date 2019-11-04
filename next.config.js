const fetch = require('isomorphic-unfetch');
// const WPAPI = require('./wp-config');

async function getPages(prefix, WPUrl){
  const response = await fetch(WPUrl)
  const postList = await response.json()
  // tranform the list of posts into a map of pages with the pathname `/post/:slug`
  const pages = postList.reduce(
    (pages, post) =>
      Object.assign({}, pages, {
        [`/${prefix}/${post.slug}`]: { page: `/${prefix}/[slug]` }
      }),
    {}
  )
  return pages;
}

module.exports = {
  async exportPathMap () {
   
    let pages = await getPages('post','https://host.mildronize.com/wp-json/api/v1/posts');
    pages = Object.assign({}, pages, 
      await getPages('page','https://host.mildronize.com/wp-json/api/v1/pages/')
    );
    return Object.assign({}, pages, {
      '/': { page: '/' }
    })
  }
}
