import React from 'react';
import clsx from 'clsx';
import Link from '@docusaurus/Link';
import useDocusaurusContext from '@docusaurus/useDocusaurusContext';
import Layout from '@theme/Layout';

import styles from './index.module.css';

function HomepageHeader() {
    const {siteConfig} = useDocusaurusContext();
    return (
        <header className={clsx('hero hero--primary', styles.heroBanner)}>
            <div className="container">
                <img className={styles.logo} src="/img/logo.png" width={360} alt="Imagezen Logo"/>
                {/*<h1 className="hero__title">{siteConfig.title}</h1>*/}
                <p className="hero__subtitle"><i>{siteConfig.tagline}</i></p>
                <div className={styles.buttons}>
                    <Link
                        className="button button--secondary button--lg"
                        to="/docs/getting-started">
                        Getting Started 🚀
                    </Link>
                </div>
            </div>
        </header>
    );
}

export default function Home() {
    const {siteConfig} = useDocusaurusContext();
    return (
        <Layout
            title={`Welcome`}
            description="Yet another image manipulation library">
            <HomepageHeader/>
            {/*<main>*/}
            {/*    <HomepageFeatures/>*/}
            {/*</main>*/}
        </Layout>
    );
}
