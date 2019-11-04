const baseUrl = 'https://host.mildronize.com/wp-json';

const WPAPI = {    
    // allPosts: 'https://host.mildronize.com/wp-json/wp/v2/posts',     
    // My API plugin
    allPostsBySlug: `${baseUrl}/api/v1/posts`, 
    allPagesBySlug: `${baseUrl}/api/v1/pages`,
    // Default API
    allPagesById: `${baseUrl}/wp/v2/pages`,
    allPostsById: `${baseUrl}/wp/v2/posts`,
}
export default WPAPI