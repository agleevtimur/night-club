import { Col, Layout, Row } from "antd";
import { useState, useEffect } from "react";


const { Header, Sider, Content } = Layout;
const initialStateVisitors = { dancing: [ {name: "no one"} ], drinking: [ {name: "no one"} ], danceRules: null };

const Room = () => {
  let playerData = JSON.parse(localStorage.getItem('player'));
  const [song, setSong] = useState();
  const [visitors, setVisitors] = useState(initialStateVisitors);

  useEffect(() => {
    let cleanup = false;

    const play = async () => {
      const composition = playerData.shift();
      if (composition === undefined) {
        setSong({ title: "party is over!", genre: "reload page to play again" });
        setVisitors(initialStateVisitors);
        return;
      }
      setSong(composition);
      const response = await fetch(`http://127.0.0.1:8000/visitors?genre=${(composition['genre'])}&token=123123`);
      const data = await response.json();

      if (!cleanup) {
        setVisitors(data);
        setTimeout(play, composition['duration'] * 1000);
      }
    }

    play();

    return () => cleanup = true;
  }, []);

  const danceRules = visitors.danceRules === null ? '' :
    <div>
      <div>body: {visitors.danceRules.body}</div>
      <div>head: {visitors.danceRules.head}</div>
      <div>hands: {visitors.danceRules.hands}</div>
      <div>legs: {visitors.danceRules.legs}</div>
    </div>

  return <Layout style={{ textAlign: "center" }}>
    <Header>Now playing: {song === undefined ? 'nothing' : `${song.title} (${song.genre})`}</Header>
    <Layout>
      <Content style={{ padding: "100px 150px 0 150px" }}>
        <Row>
          <Col span={12}>
            On the dance floor:
            <div>
              {visitors.dancing.map(item => <div>{item.name}</div>)}
            </div>
          </Col>
          <Col span={12}>
            Vodka drinkers:
            <div>
              {visitors.drinking.map(item => <div>{item.name}</div>)}
            </div>
          </Col>
        </Row>
      </Content>
      <Sider width={300} style={{ paddingTop: "100px", paddingBottom: "30px" }}>
        Dancing rules:
        <br />
        {danceRules}
      </Sider>
    </Layout>
  </Layout>
}

export default Room;