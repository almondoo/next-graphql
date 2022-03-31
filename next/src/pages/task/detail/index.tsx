import { useEffect } from 'react';
import type { NextPage, GetServerSideProps } from 'next';
import type { TaskStatus } from 'models/task_status';
import Template from 'components/templates/TaskDetail/index';
import { FETCH_CREATE_DETAIL_QUERY, TaskCreateDetailData } from 'graphql/taskDetail/query/fetchCreateData';
import client from 'graphql/apollo-server';
import { useSetRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';

type Props = {
  task_statuses: TaskStatus[];
};

const TaskCreateDetail: NextPage<Props> = ({ task_statuses }) => {
  const setTitle = useSetRecoilState<string>(pageTitle);

  useEffect(() => {
    setTitle('TaskDetail');
  });

  return <Template task_statuses={task_statuses} />;
};

export const getServerSideProps: GetServerSideProps = async () => {
  const { data } = await client.query<TaskCreateDetailData>({
    query: FETCH_CREATE_DETAIL_QUERY,
  });

  return {
    props: {
      task_statuses: data.task_statuses,
    },
  };
};

export default TaskCreateDetail;
