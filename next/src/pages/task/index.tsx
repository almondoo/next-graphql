import { useEffect } from 'react';
import type { NextPage, NextPageContext } from 'next';
import type { Task } from 'models/task';
import type { Paginate } from 'models/utils';
import { useSetRecoilState, useRecoilState } from 'recoil';
import { pageTitle } from 'recoil/title/atom';
import { taskPage } from 'recoil/page/atom';
import { FETCH_TASKS_QUERY } from 'graphql/task/query/fetchTask';
import servier from 'graphql/apollo-server';
import Template from 'components/templates/Task/index';
import { useQuery } from '@apollo/client';

type Props = {
  tasks: Task[];
  paginate: Paginate;
};

type Task_QUERY = {
  tasks: {
    data: Task[];
    paginatorInfo: Paginate;
  };
};

const TaskPage: NextPage<Props> = ({ tasks, paginate }) => {
  const setTitle = useSetRecoilState<string>(pageTitle);
  const [stateTaskPage, setTaskPage] = useRecoilState<number>(taskPage);
  const { loading, error, data } = useQuery<Task_QUERY>(FETCH_TASKS_QUERY, {
    variables: {
      page: stateTaskPage ?? 1,
    },
  });

  useEffect(() => {
    setTitle('Task');
    setTaskPage(paginate.currentPage);
  }, []);

  return (
    <Template
      isLoad={loading}
      tasks={!loading && !error && data ? data.tasks.data : tasks}
      paginate={!loading && !error && data ? data.tasks.paginatorInfo : paginate}
    />
  );
};

export async function getServerSideProps(ctx: NextPageContext) {
  const page = Number(ctx.query.page) ?? 1;
  const { data } = await servier.query({
    query: FETCH_TASKS_QUERY,
    variables: {
      page: page,
    },
  });

  return {
    props: {
      tasks: data.tasks.data,
      paginate: data.tasks.paginatorInfo,
    },
  };
}

export default TaskPage;
