import { Component } from 'react'
import Head from 'next/head'
import fetch from 'isomorphic-unfetch'
import WPAPI from '../wp-config';
import Link from 'next/link';

// import Post from '../components/post'

export default class extends Component {
  static async getInitialProps() {
    // fetch list of posts
    const response = await fetch(
      WPAPI.allPostsBySlug
    )
    const postList = await response.json()
    return { postList }
  }

  render() {
    return (
      <main>
        <Head>
          <title>Home page</title>
        </Head>

        <Link href='/page/[slug]' as={`/page/about`}>
          <a>Read more...</a>
        </Link>

        <h1>List of posts</h1>

        <section>
          {this.props.postList.map(post => (
            <div key={post.id}>
              <h2>{post.title}</h2>
              {/* <p>{post.content}</p> */}
              <Link href='/post/[slug]' as={`/post/${post.slug}`}>
                <a>Read more...</a>
              </Link>
            </div>
          ))}

        </section>
      </main>
    )
  }
}
